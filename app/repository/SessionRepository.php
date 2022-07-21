<?php

namespace App\Native\Repository;

use App\Native\Domain\Session;
use App\Native\Domain\User;
use App\Native\Model\UserLoginRequest;
use App\Native\Model\UserLoginResponse;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Session $request): UserLoginResponse
    {
        $statement = $this->connection->prepare("INSERT INTO sessions(id, user_id) VALUES (?, ?)");
        $statement->execute([$request->getId(), $request->getUserId()]);

        $user = new User();
        $user->id = $request->getId();
        $user->name = $request->getUserId();

        $userResponse = new UserLoginResponse();
        $userResponse->user = $user;
        return $userResponse;
    }

    public function findById(string $id): ?Session
    {
        $statement =  $this->connection->prepare("SELECT id, user_id FROM sessions WHERE id = ?");
        $statement->execute([$id]);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $session = new Session();
            $session->setId($row['id']);
            $session->setUserId($row['user_id']);
            return $session;
        } else {
            return null;
        }
    }
}
