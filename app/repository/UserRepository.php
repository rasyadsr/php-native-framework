<?php

namespace App\Native\Repository;

use PDO;
use User;

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

    public function findById($user)
    {
        $statement = $this->connection->prepare("SELECT name, password FROM users WHERE name = :name AND password = :password ");
        $statement->bindParam(':name', $user->name);
        $statement->bindParam(':password', $user->password);
        $statement->execute();

        if ($statement->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
