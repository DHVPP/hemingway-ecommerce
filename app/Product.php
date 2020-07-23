<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['name', 'idType', 'price', 'quantityInStock', 'mainImage'];
}
