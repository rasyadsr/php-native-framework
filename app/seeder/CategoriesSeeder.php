<?php

namespace App\Native\Seeder;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Native\Core\Database;
use App\Native\Domain\Category;
use App\Native\Repository\CategoryRepository;
use Faker\Factory;

class CategoriesSeeder
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::connect('prod');
        $this->deleteAll();
    }

    public function insertSeeder(int $jumlah)
    {
        $faker = Factory::create();
        $data = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $data[] = [
                'id' => mt_rand(1, 5),
                'name' => $faker->word()
            ];
        }
        $result = $this->queryInsertSeeder($data, $jumlah);
        return $result;
    }

    private function queryInsertSeeder(array $data)
    {
        for ($i = 0; $i < count($data); $i++) {
            $statement = $this->connection->prepare("INSERT INTO categories(id, name) VALUES (:id, :name)");
            $statement->bindParam(':id', $data[$i]['id']);
            $statement->bindParam(':name', $data[$i]['name']);
            $result = $statement->execute();
        }
        return $result;
        // return $category;
    }

    private function deleteAll()
    {
        $statement =  $this->connection->query("DELETE FROM categories");
        $statement->execute();
    }
}

$categoriesSeeder = new CategoriesSeeder();
var_dump($categoriesSeeder->insertSeeder(10));
