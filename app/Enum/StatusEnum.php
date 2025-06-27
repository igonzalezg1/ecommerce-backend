<?php

namespace App\Enum;

enum StatusEnum: string
{
    case CARRITO    = 'carrito';
    case PENDIENTE  = 'pendiente';
    case COMPLETADA = 'completada';
    case CANCELADA  = 'cancelada';
}
