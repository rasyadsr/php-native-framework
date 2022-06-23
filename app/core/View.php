<?php

namespace App\Native\Core;

class View
{
    public static function render(string $view, $data = []): void
    {
        require_once __DIR__ . "/../view/templates/header.php";
        require_once __DIR__ . "/../view/" . $view . ".php";
        require_once __DIR__ . "/../view/templates/footer.php";
    }
}
