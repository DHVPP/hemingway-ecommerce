<?php

namespace App\Http\Controllers;

use App\Entities\Orders\OnDeliveryOrder;
use App\Entities\Orders\PostPaymentOrder;
use App\Entities\Payments\PaymentMethod;
use App\Mail\ConfirmOrderMailable;
use App\Mail\OrderCreateCustomerMailable;
use App\Order;
use App\OrderProduct;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * Class OrderController
 * @package App\Http\Controllers
 */
class OrderController extends Controller
{
    /**
     *
     */
    const PAYMENT_METHOD_TEXT = [
        PaymentMethod::ON_DELIVERY => 'Plaćanje pouzećem',
        PaymentMethod::POST_PAYMENT => 'Uplata na žiro račun'
    ];

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function checkout()
    {
        $products = Session::get('products');
        return view('pages.checkout.index', !empty($products) ? $products : []);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $order = Order::where('id', $id)->first();

        $id = 0;
        $orderProducts = [];
        foreach ($order->products as $product) {
            $prod = $product->product()->withTrashed()->first();
            $orderProducts[] = [
                'id' => $id++,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'color' => $product->color,
                'product' => $prod,
                'personalisation' => $product->personalisation
            ];
        }

        return view('admin.pages.order', [
            'data' => [
                'id' => $order->id,
                'name' => $order->name,
                'email' => $order->email,
                'paymentMethod' => self::PAYMENT_METHOD_TEXT[$order->idPaymentMethod],
                'address' => $order->address . ', ' . $order->city . ' ' . $order->zipCode . ', ' . $order->country,
                'products' => $orderProducts,
                'sum' => $order->price,
                'status' => $order->status,
                'deliveryName' => $order->deliveryName,
                'deliveryPhone' => $order->deliveryPhone,
                'note' => $order->note
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(Request $request)
    {
        switch ($request->get('action')) {
            case 'on-delivery':
                $data = $this->createOrder($request, new OnDeliveryOrder);
                break;
            case 'post-payment':
                $data = $this->createOrder($request, new PostPaymentOrder);
                break;
        }

        if (!is_array($data)) {
            return $data;
        }

        return view('pages.checkout.page-invoice', [
            'data' => $data
        ]);
    }

    /**
     * Dont ask what im doing in this method
     *
     * @param Request $request
     * @param Order $model
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createOrder(Request $request, Order $model)
    {
        $deliveryAmount = 0;
        $productAmount = 0;
        $order = $request->all();
        if (!Session::has('products')) {
            return redirect('/');
        }

        $products = Session::get('products');
        $order['price'] = Session::get('cartSum');

        if ($order['price'] <= Order::DELIVERY_LIMIT) {
            $order['price'] = $order['price'] + Order::DELIVERY_PRICE;
            $deliveryAmount = Order::DELIVERY_PRICE;
        }
        $newOrder = $model->createOrder($order);

        $orderProducts = [];
        $i = 0;
        foreach (Session::get('products') as $product) {
            $productAmount += $product['price'];
            $prod = Product::find($product['product']->id);
            if (!$prod instanceof Product || $prod->quantityInStock == 0){
                $newOrder->delete();
                $j = 0;
                foreach (Session::get('products') as $p) {
                    if ($j == $i) break;
                    $rollbackProduct = Product::find($p['product']->id);
                    $rollbackProduct->quantityInStock += $p['quantity'];
                    $rollbackProduct->save();
                    $j++;
                }
                return back()->with('errors_quantity', 'Nemamo toliko proizvoda na stanju!');
            }

            $orderProducts[] = [
                'idOrder' => $newOrder->id,
                'idProduct' => $product['product']->id,
                'quantity' => $product['quantity'],
                'color' => $product['color'],
                'price' => $prod->getPrice() * $product['quantity'],
                'personalisation' => $product['personalisation']
            ];

            $prod->quantityInStock -= $product['quantity'];
            $prod->save();
            $i++;
        }
        OrderProduct::insert($orderProducts);
        $data = [
            'id' => $newOrder->id,
            'date' => (new \DateTime())->format('d.m.Y'),
            'name' => $newOrder->name,
            'email' => $newOrder->email,
            'paymentMethod' => self::PAYMENT_METHOD_TEXT[$newOrder->idPaymentMethod],
            'idPaymentMethod' => $newOrder->idPaymentMethod,
            'address' => $newOrder->address . ', ' . $newOrder->city . ' ' . $newOrder->zipCode . ', ' . $newOrder->country,
            'products' => $products,
            'sum' => $newOrder->price,
            'deliveryName' => $newOrder->deliveryName,
            'deliveryPhone' => $newOrder->deliveryPhone,
            'note' => $newOrder->note,
            'productSum' => $productAmount,
            'delivery' => $deliveryAmount
        ];

        Session::remove('products');
        Session::remove('cartSum');

        return $data;
    }

    /**
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setOrderStatus(int $id, Request $request)
    {
        $status = $request->get('status');
        $order = Order::find($id);
        $order->status = $status;

        /*if ($request->has('free-delivery')) {
            $isFreeDelivery = true;
        }*/

        if ($status == Order::STATUS_DENIED) {
            foreach ($order->products as $orderProduct) {
                $orderProduct->product->quantityInStock += $orderProduct->quantity;
                $orderProduct->product->save();
            }
        }
        $order->save();

        /*try {
            $products = [];
            foreach ($order->products as $orderProduct) {
                $products[] = [
                    'quantity' => $orderProduct->quantity,
                    'price' => $orderProduct->product->price * $orderProduct->quantity,
                    'product' => $orderProduct->product
                ];
            }
            $data = [
                'id' => $order->id,
                'date' => (new \DateTime())->format('d.m.Y'),
                'name' => $order->name,
                'email' => $order->email,
                'paymentMethod' => self::PAYMENT_METHOD_TEXT[$order->idPaymentMethod],
                'idPaymentMethod' => $order->idPaymentMethod,
                'address' => $order->address . ', ' . $order->city . ' ' . $order->zipCode . ', ' . $order->country,
                'products' => $products,
                'sum' => $order->price,
                'deliveryName' => $order->deliveryName,
                'deliveryPhone' => $order->deliveryPhone
            ];
            //Mail::send(new ConfirmOrderMailable($data, (isset($isFreeDelivery) ? $isFreeDelivery : null)));
        } catch (\Exception $exception) {
            info('MAIL ERROR: ' . $exception->getMessage());
        }*/

        return $this->show($id);
    }
}
