<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentInit extends Model
{
    protected $fillable = ['price', 'currencyCode', 'paymentOrderInfo'];
}
