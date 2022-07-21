<?php

namespace App\Native\Repository;

use App\Native\Domain\Category;

class CategoryRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function insert(Category $category)
    {
        $statement = $this->connection->query("INSERT INTO category(id, name) VALUES (?, ?)");
        $statement->execute([$category->id, $category->name]);
        return $statement->rowCount();
    }
}
