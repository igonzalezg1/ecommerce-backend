<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ventas\AddCar;
use App\Services\VentasService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends BaseController
{
    protected VentasService $ventasService;

    public function __construct(VentasService $ventasService)
    {
        $this->ventasService = $ventasService;
    }
    public function index(): JsonResponse
    {
        try {
            $filter = request()->input('filter', '');
            $paginate = request()->input('paginate', 5);
            $page = request()->input('page', 1);
            $response_data = $this->ventasService->index($filter, $paginate, $page);

            return $this->responseok($response_data, 'Lista de ventas obtenida correctamente');
        } catch (Exception $exception) {
            return $this->responseError($exception->getMessage());
        }
    }

    public function addCar(AddCar $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data_response = $this->ventasService->addCar($data);
            DB::commit();
            return $this->responseCreated($data_response, 'Producto agregado al carrito correctamente');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError($exception->getMessage());
        }
    }
}
