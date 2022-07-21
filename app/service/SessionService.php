<?php

namespace App\Native\Service;

use App\Native\Core\Database;
use App\Native\Domain\Session;
use App\Native\Domain\User;
use App\Native\Model\UserLoginRequest;
use App\Native\Repository\SessionRepository;
use App\Native\Repository\UserRepository;

class SessionService
{
    public static string $COOKIE_NAME = "X-BABY-NATIVE";

    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->userRepository = new UserRepository(Database::connect());
        $this->sessionRepository = new SessionRepository(Database::connect());
    }

    public function create(User $user)
    {
        $session = new Session();
        $session->setId(uniqid());
        $session->setUserId($user->id);
        setcookie(self::$COOKIE_NAME, $session->getId(), time() + 3600, '/');
        $this->sessionRepository->save($session);
    }

    public function getCurrentSession(): ?Session
    {
        $id = $_COOKIE[self::$COOKIE_NAME];
        $result = $this->sessionRepository->findById($id);
        if ($result != null) {
            $session = new Session();
            $session->setId($result->getId());
            $session->setUserId($result->getUserId());
            return $session;
        } else {
            return null;
        }
    }
}
