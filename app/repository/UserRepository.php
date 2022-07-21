<?php

namespace App\Native\Repository;

use App\Native\Domain\Session;
use App\Native\Domain\User;
use PDO;

class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function all()
    {
        $result = $this->connection->query("SELECT id, name, password FROM users");
        $array = [];
        while ($row = $result->fetch()) {
            $array[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password'],
            ];
        }
        return $array;
    }

    public function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT id, name, password FROM users WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->password = $row['password'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function save($user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(id, name, password) VALUES(?,?,?)");
        $statement->execute([$user->id, $user->name, $user->password]);
        $user = new User();
        $user->id = $user->id;
        $user->name = $user->name;
        $user->password = $user->password;
        return $user;
    }
}
