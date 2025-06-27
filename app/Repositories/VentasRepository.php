<?php

namespace App\Repositories;

use App\Enum\StatusEnum;
use App\Models\Venta;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class VentasRepository.
 */
class VentasRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Venta::class;
    }

    public function getFilteredPaginatedVentas(string $filter = '', int $paginate = 5, int $page = 1): LengthAwarePaginator
    {
        $this->newQuery();

        $this->query->with('detalles');

        if ($filter !== '') {
            $this->query->where('fecha_venta', 'like', "%{$filter}%");
        }

        return $this->query->paginate($paginate, ['*'], 'page', $page);
    }

    public function verifyHaveCar(): bool
    {
        $user_id = auth()->user()->id;
        $venta = Venta::where('user_id', $user_id)
            ->where('estado', StatusEnum::CARRITO->value)
            ->first();
        return $venta !== null;
    }

    public function createCar(array $data): array
    {
        $user_id = auth()->user()->id;
        $venta = Venta::create([
            'user_id' => $user_id,
            'subtotal' => 0,
            'iva' => 0,
            'total' => 0,
            'fecha_venta' => now(),
            'estado' => StatusEnum::CARRITO->value,
        ]);

        $venta->detalles()->create([
            'producto_id' => $data['producto_id'],
            'cantidad' => $data['cantidad'],
            'total_producto' => $data['total_producto'],
        ]);

        $venta->total += $data['total_producto'];
        $venta->iva += $data['total_producto'] * 0.16;
        $venta->subtotal = $venta->total + $venta->iva;
        $venta->save();

        $venta->load('detalles');
        return $venta->toArray();
    }

    public function addProductToCar(array $data): array
    {
        $user_id = auth()->user()->id;
        $venta = Venta::where('user_id', $user_id)
            ->where('estado', StatusEnum::CARRITO->value)
            ->first();

        if (!$venta) {
            throw new \Exception('No hay carrito activo para el usuario.');
        }

        $venta->detalles()->create([
            'producto_id' => $data['producto_id'],
            'cantidad' => $data['cantidad'],
            'total_producto' => $data['total_producto'],
        ]);

        $venta->total += $data['total_producto'];
        $venta->iva += $data['total_producto'] * 0.16;
        $venta->subtotal = $venta->total + $venta->iva;
        $venta->save();

        $venta->load('detalles');
        return $venta->toArray();
    }
}
