<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'lokasi',
        'satuan',
        'stock',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
