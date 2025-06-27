<?php

namespace App\Http\Controllers;

use App\Http\Requests\product\ProductRequest;
use App\Models\Producto;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $filter = request()->input('filter', '');
            $paginate = request()->input('paginate', 5);
            $page = request()->input('page', 1);
            $response_data = $this->productService->index($filter, $paginate, $page);

            return $this->responseOk($response_data, 'Lista de productos obtenida correctamente');
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $response_data = $this->productService->store($data);

            DB::commit();
            return $this->responseCreated($response_data, 'Producto creado correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Producto $product): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $response_data = $this->productService->update($data, $product);

            DB::commit();
            return $this->responseOk($response_data, 'Producto actualizado correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $product): JsonResponse
    {
        DB::beginTransaction();
        try {
            $response_data = $this->productService->destroy($product);

            DB::commit();
            return $this->responseOk($response_data, 'Producto eliminado correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }
}
