<?php

namespace App\Native\Seeder;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Native\Core\Database;
use App\Native\Model\Post;
use App\Native\Repository\PostRepository;
use Faker\Factory;

class PostFactory
{
    // private Factory $faker;
    private PostRepository $postRepository;


    public function __construct()
    {
        $this->postRepository = new PostRepository(Database::connect('prod'));
        $this->postRepository->deleteAllFaker();
    }

    public function create(int $jumlah)
    {
        $faker = Factory::create();
        for ($i = 0; $i < $jumlah; $i++) {
            $data[] = [
                'title' => $faker->sentence(),
                'body' => implode(" ", array_map(fn ($p) => "<p>$p</p>", $faker->paragraphs())),
                'category_id' => mt_rand(1, 5),
                'user_id' => mt_rand(1, 5),
                'comment_id' => mt_rand(1, 5),
            ];
        }

        $result = $this->postRepository->saveFaker($data, $jumlah);
        return $result;
    }
}


$postFactory = new PostFactory();
var_dump($postFactory->create(10));
