<?php

namespace App\Native\Controller;

use App\Native\Core\Database;
use App\Native\Core\View;
use App\Native\Repository\PostRepository;
use App\Native\Repository\UserRepository;

class HomeController
{
    private PostRepository $postRepository;

    public function __construct()
    {
        $connection = Database::connect();
        $this->postRepository = new PostRepository($connection);
    }

    public function index()
    {
        View::render('home/index', [
            'title' => 'Home Page',
            'posts' => $this->postRepository->all()
        ]);
    }

    public function readPost($id_post)
    {
        View::render('home/read', [
            'title' => 'Read Post',
            'post'  => $this->postRepository->findById($id_post)
        ]);
    }
}
