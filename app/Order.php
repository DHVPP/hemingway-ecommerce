<?php

namespace App;

use App\Entities\Payments\PaymentMethod;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $idPaymentMethodType;
    protected $table = 'orders';
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['email', 'name', 'phoneNumber', 'address', 'country', 'city', 'zipCode', 'price', 'idPaymentMethod', 'deliveryName', 'deliveryPhone', 'note'];

    const
        DELIVERY_PRICE = 250,
        DELIVERY_LIMIT = 5000;

    const
        STATUS_PENDING = 1,
        STATUS_CONFIRMED = 2,
        STATUS_DENIED = 3;

    public static function getStatusText(int $status): string
    {
        switch ($status) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_CONFIRMED:
                return 'Confirmed';
            case self::STATUS_DENIED:
                return 'Denied';
        }
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'idOrder');
    }

    public function createOrder(array $data)
    {
        $data['idPaymentMethod'] = $this->idPaymentMethodType;
        return self::create($data);
    }
}
