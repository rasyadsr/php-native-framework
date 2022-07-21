<?php

namespace App\Native\Service;

use App\Native\Core\Database;
use App\Native\Exception\ValidationException;
use App\Native\Model\UserLoginRequest;
use App\Native\Model\UserLoginResponse;
use App\Native\Model\UserRegisterRequest;
use App\Native\Repository\SessionRepository;
use App\Native\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    private SessionService $sessionService;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $sessionRepository = new SessionRepository(Database::connect('prod'));
        $this->sessionService = new SessionService($sessionRepository, $this->userRepository);
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findById($request->id);

        if ($user == null) {
            throw new ValidationException("Id or Password is wrong");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse;
            $response->user = $user;
            $this->sessionService->create($user);
            return $response;
        } else {
            throw new ValidationException("Id or Password is wrong");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if ($request->id == null || $request->password == null || trim($request->id) == "" || trim($request->password) == "") {
            throw new ValidationException("Id, Password can not blank");
        }
    }

    public function register(UserRegisterRequest $request)
    {
        $user = $this->userRepository->findById($request);
        if ($user) {
            throw new \Exception("Id or Username already exist!");
        }
        $s = $this->userRepository->save($request);
        var_dump($s);
    }
}
