<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name', 'text', 'idProduct', 'isApproved'];

    public function productName()
    {
        $product = $this->belongsTo(Product::class, 'idProduct')->withTrashed()->first();
        return $product->name;
    }
}
