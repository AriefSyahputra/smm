<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $table = 'departement';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
