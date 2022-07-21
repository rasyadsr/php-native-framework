<?php

namespace App\Native\Controller;

use App\Native\Core\Database;
use App\Native\Core\View;
use App\Native\Exception\ValidationException;
use App\Native\Model\UserLoginRequest;
use App\Native\Model\UserRegisterRequest;
use App\Native\Repository\SessionRepository;
use App\Native\Repository\UserRepository;
use App\Native\Service\SessionService;
use App\Native\Service\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::connect());
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository(Database::connect());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function login()
    {
        View::render('user/login', [
            'title' => 'Login Page',
        ]);
    }

    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->id = htmlspecialchars($_POST['id']);
        $request->password = htmlspecialchars($_POST['password']);
        try {
            $this->userService->login($request);
            View::redirect('/dashboard');
        } catch (ValidationException $exception) {
            View::render('/user/login', [
                'title' => "Login Page",
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function register()
    {
        View::render('user/register', [
            'title' => 'Register Page',
        ]);
    }

    public function postRegister()
    {
        $request = new UserRegisterRequest();
        $request->id = htmlspecialchars($_POST['id']);
        $request->name = htmlspecialchars($_POST['name']);
        $request->password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
        $this->userService->register($request);
    }
}
