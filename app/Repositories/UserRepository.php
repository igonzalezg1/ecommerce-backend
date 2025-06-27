<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function model()
    {
        return User::class;
    }

    public function getFilteredPaginatedUsers($filter = '', $limit = 25, $page = 1): LengthAwarePaginator
    {
        $this->newQuery();

        if ($filter != '') {
            return $this->query->where(function ($query) use ($filter) {
                $query->where('first_name', 'like', "%{$filter}%")
                    ->orWhere('last_name', 'like', "%{$filter}%")
                    ->orWhere('email', 'like', "%{$filter}%");
            })->paginate($limit, ['*'], 'page', $page);
        } else {
            return $this->paginate($limit, ['*'], 'page', $page);
        }
    }
}
