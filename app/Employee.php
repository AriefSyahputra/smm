<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    protected $fillable = [
        'departement_id',
        'nik',
        'name',
        'gender',
        'phone',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
