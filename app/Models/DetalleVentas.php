<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'total_producto',
    ];
}
