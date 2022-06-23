<?php

class UserRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=localhost;dbname=php_login_management", "root", "");
    }

    public function findOne($user)
    {
        $statement = $this->connection->prepare("SELECT id, name, password FROM users WHERE name = ?");
        $statement->execute([$user->name]);
        $result = $statement->rowCount();
        return $result;
    }
}

class User
{
    public ?string $name = null;
    public ?string $password = null;
}

$user = new User();
$user->name = "Rasyad";
$user->password = "rahasia";

$userRepository = new UserRepository();
$result = $userRepository->findOne($user);
if ($result > 1) {
    echo "Berhasil Login";
} else {
    echo "Gagal Login, silahkan daftar terlebih dahulu";
}
