<?php

namespace App\Http\Controllers;

use App\Config;
use App\Label;
use App\Order;
use App\Product;
use App\ProductColor;
use App\ProductLabel;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $orders = Order::orderBy('id', 'desc')->take(30)->get();
        return view('admin.pages.home', ['orders' => $orders]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function announcement()
    {
        $annon = '';
        $announcement = Config::where('key', Config::CONFIG_ANNOUNCEMENT)->first();
        if ($announcement instanceof Config)
            $annon = $announcement->value;
        return view('admin.pages.announcement', ['announcement' => $annon]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveAnnouncement(Request $request)
    {
        $announcement = $request->get('announcement');
        Config::updateOrCreate(['key' => Config::CONFIG_ANNOUNCEMENT], ['value' => $announcement]);
        return view('admin.pages.announcement', ['announcement' => $announcement]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function labels(int $id)
    {
        $labels = Label::all();
        $checkedLabels = ProductLabel::where('idProduct', $id)->get();
        return view('admin.pages.product-label', [
            'labels' => $labels,
            'checkedLabels' => !empty($checkedLabels) ? $checkedLabels->pluck('idLabel')->toArray() : [],
            'idProduct' => $id
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     */
    public function storeLabels(int $id, Request $request)
    {
        $data = $request->all();
        if (isset($data['labels']))
        {
            $productLabels = ProductLabel::where('idProduct', $id)->get();

            $idLabels = $productLabels->pluck('idLabel')->toArray();
            $idNewLabels = $data['labels'];

            $idToBeDeletedLabels = array_diff($idLabels, $idNewLabels);

            ProductLabel::whereIn('idLabel', $idToBeDeletedLabels)->where('idProduct', $id)->delete();

            foreach($idNewLabels as $idNewLabel) {
                $label = [
                    'idLabel' => $idNewLabel,
                    'idProduct' => $id
                ];
                ProductLabel::updateOrCreate($label, $label);
            }
        } else {
            ProductLabel::where('idProduct', $id)->delete();
        }
        return redirect('products/' . $id);
    }
}
