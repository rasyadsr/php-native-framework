<?php

namespace App\Native\Controller;

use App\Native\Core\Database;
use App\Native\Core\View;
use App\Native\Domain\User;
use App\Native\Repository\UserRepository;
use App\Native\Service\UserService;
use Exception;

class UserController
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(Database::connect());
        $this->userService = new UserService();
    }

    public function login()
    {
        View::render('user/login', [
            'title' => 'Login Page',
        ]);
    }

    public function postLogin()
    {
        $request = new User();
        $request->name = htmlspecialchars($_POST['name']);
        $request->password = htmlspecialchars($_POST['password']);
        try {
            $result = $this->userService->login($request);
            if ($result) {
                echo "Berhasil Login dengan username $request->name";
            } else {
                echo "Gagal Login, silahkan buat akun terlebih dahulu";
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
