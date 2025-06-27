<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'imagen',
        'activo',
    ];

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVentas::class, 'producto_id');
    }

    public function stock()
    {
        return $this->hasMany(Stock::class, 'producto_id');
    }
}
