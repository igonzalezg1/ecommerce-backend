<?php

namespace App\Services;

use App\Repositories\UserRepository;

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
}
