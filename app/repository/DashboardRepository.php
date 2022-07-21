<?php

namespace App\Native\Repository;

class DashboardRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getPostByUserWhoLogin()
    {
        $statement = $this->connection->query("SELECT posts.id, title, body, comment_id, user_id, category_id, created_at, updated_at, categories.name AS category_name FROM posts LEFT JOIN categories ON categories.id = posts.category_id");
        $statement->execute();
        $result = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = [
                'title' => $row['title'],
                'body' => $row['body'],
                'category' => $row['category_name'],
            ];
        }
        return $result;
    }
}
