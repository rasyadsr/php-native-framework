<?php

namespace App\Native\Service;

use App\Native\Core\Database;
use App\Native\Domain\User;
use App\Native\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::connect());
    }

    public function login(User $user)
    {
        $result = $this->userRepository->findById($user);
        return $result;
    }
}
