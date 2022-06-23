<?php

namespace App\Native\Controller;

use App\Native\Core\Database;
use App\Native\Core\View;
use App\Native\Repository\UserRepository;

class HomeController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $connection = Database::connect();
        $this->userRepository = new UserRepository($connection);
    }

    public function index()
    {
        View::render('home/index', [
            'title' => 'Login Page',
            'users' => $this->userRepository->all()
        ]);
    }
}
