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


    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
