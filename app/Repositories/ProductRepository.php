<?php

namespace App\Repositories;

use App\Models\Producto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Producto::class;
    }


    public function getFilteredPaginatedProducts($filter = '', $limit = 25, $page = 1): LengthAwarePaginator
    {
        $this->newQuery();

        if ($filter != '') {
            return $this->query->where(function ($query) use ($filter) {
                $query->where('name', 'like', "%{$filter}%")
                    ->orWhere('description', 'like', "%{$filter}%");
            })->paginate($limit, ['*'], 'page', $page);
        } else {
            return $this->paginate($limit, ['*'], 'page', $page);
        }
    }
}
