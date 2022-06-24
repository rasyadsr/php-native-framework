<?php

namespace App\Native\Model;

class Post
{
    private int $id;
    private string $title;
    private string $body;
    private int $category_id;
    private string $user_id;
    private string $comment_id;

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setCommentId(int $comment_id)
    {
        $this->comment_id = $comment_id;
    }

    public function getCommentId()
    {
        return $this->comment_id;
    }
}
