<?php

namespace App\Native\Repository;

use App\Native\Model\Post;

class PostRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function all()
    {
        $result = $this->connection->query("SELECT id, title, body, comment_id, user_id, category_id, created_at, updated_at FROM posts");
        $array = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $array[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'category_id' => $row['category_id'],
                'user_id' => $row['user_id'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'comment_id' => $row['comment_id'],
            ];
        }
        return $array;
    }

    public function findById($id): array
    {
        $statement = $this->connection->prepare("SELECT id, title, body, comment_id, user_id, category_id, created_at, updated_at FROM posts WHERE id = ?");
        $statement->execute([$id]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    public function save(Post $post)
    {
        $query = "INSERT INTO posts(title, body, category_id, user_id, comment_id) 
                    VALUES(:title, :body, :category_id, :user_id, :comment_id)";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':title', $post->getTitle());
    }

    // Faker 

    public function saveFaker(array $data, int $jumlah): bool
    {
        for ($index = 0; $index < $jumlah; $index++) {
            $query = "INSERT INTO posts(title, body, category_id, user_id, comment_id) 
            VALUES(:title, :body, :category_id, :user_id, :comment_id)";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':title', $data[$index]['title']);
            $statement->bindParam(':body', $data[$index]['body']);
            $statement->bindParam(':category_id', $data[$index]['category_id']);
            $statement->bindParam(':user_id', $data[$index]['user_id']);
            $statement->bindParam(':comment_id', $data[$index]['comment_id']);
            $result = $statement->execute();
        }
        return $result;
    }

    public function deleteAllFaker()
    {
        $this->connection->query("DELETE FROM posts");
    }
}
