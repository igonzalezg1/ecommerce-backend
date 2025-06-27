<?php

namespace App\Services;

use App\Models\Producto;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(string $filter = '', int $paginate = 5, int $page = 1): LengthAwarePaginator
    {
        return $this->productRepository->getFilteredPaginatedProducts($filter, $paginate, $page);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data): Model
    {
        return $this->productRepository->create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, Producto $producto): Producto
    {
        $producto->update($data);
        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto): Producto
    {
        $producto->delete();
        return $producto;
    }
}
