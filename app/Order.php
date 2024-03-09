<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'employee_id',
        'order_no',
        'order_date',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
