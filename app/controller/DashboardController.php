<?php

namespace App\Native\Controller;

use App\Native\Core\Database;
use App\Native\Core\View;
use App\Native\Domain\User;
use App\Native\Repository\DashboardRepository;
use App\Native\Repository\PostRepository;
use App\Native\Repository\SessionRepository;
use App\Native\Repository\UserRepository;
use App\Native\Service\SessionService;

class DashboardController
{
    private DashboardRepository $dashoardRepository;
    private SessionService $sessionService;
    private PostRepository $posstRepository;

    public function __construct()
    {
        $connection = Database::connect();
        $this->dashoardRepository = new DashboardRepository($connection);

        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);

        $this->posstRepository = new PostRepository($connection);
    }

    public function index()
    {
        View::template('dashboard/index', [
            'title' => "Dashboard",
            'user' => [
                'name' => $this->sessionService->getCurrentSession()->getUserId()
            ],
            'posts' => $this->dashoardRepository->getPostByUserWhoLogin()
        ]);
    }

    public function myPost()
    {
        $session = $this->sessionService->getCurrentSession();

        if ($session != null) {
            $user = new User;
            $user->id = $session->getUserId();

            View::template("dashboard/myPost", [
                'title' => 'My Post',
                'user' => [
                    'name' => $this->sessionService->getCurrentSession()->getUserId()
                ],
                'posts' => $this->posstRepository->showByUserId($user)
            ]);
        } else {
            return false;
        }
    }

    public function searchMyPost()
    {
        $data = json_decode(file_get_contents("php://input"));
        $result = $this->posstRepository->search($data);
        print_r($result);
    }
}
