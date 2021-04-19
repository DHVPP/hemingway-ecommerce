<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['idProduct', 'idOrder', 'quantity', 'color', 'personalisation', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct')->withTrashed();
    }
}
