<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'user_id',
        'subtotal',
        'iva',
        'total',
        'fecha_venta',
    ];
}
