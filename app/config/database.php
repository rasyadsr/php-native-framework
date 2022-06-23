<?php

function getDatabaseConfig()
{
    return [
        'database' => [
            'prod' => [
                'url' => "mysql:host=localhost;dbname=php_login_management",
                'username' => "root",
                "password" => ""
            ],
            'test' => [
                'url' => "mysql:host=localhost;dbname=php_login_management_test",
                'username' => "root",
                "password" => ""
            ]
        ]
    ];
}
