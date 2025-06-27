<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService.
 */
class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(string $filter = '', int $paginate = 5, int $page = 1): LengthAwarePaginator
    {
        return $this->userRepository->getFilteredPaginatedUsers($filter, $paginate, $page);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data): Model
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, User $user): User
    {
        $user->update($data);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): User
    {
        $user->delete();
        return $user;
    }
}
