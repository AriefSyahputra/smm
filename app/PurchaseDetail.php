<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_detail';

    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
    ];
}
