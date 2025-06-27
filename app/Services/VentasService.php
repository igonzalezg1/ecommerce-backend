<?php

namespace App\Services;

use App\Repositories\VentasRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VentasService
{

    protected VentasRepository $ventasRepository;

    public function __construct(VentasRepository $ventasRepository)
    {
        $this->ventasRepository = $ventasRepository;
    }

    public function index(string $filter = '', int $paginate = 5, int $page = 1): LengthAwarePaginator
    {
        return $this->ventasRepository->getFilteredPaginatedVentas($filter, $paginate, $page);
    }

    public function addCar(array $data): array
    {
        $verified = $this->ventasRepository->verifyHaveCar();
        if ($verified) {
            return $this->ventasRepository->addProductToCar($data);
        } else {
            return $this->ventasRepository->createCar($data);
        }
    }
}
