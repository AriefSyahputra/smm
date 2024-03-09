<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';

    protected $fillable = [
        'purchase_no',
        'purchase_date',
        'suplier',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
