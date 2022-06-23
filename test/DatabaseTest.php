<?php

namespace App\Native\Core;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

class DatabaseTest extends TestCase
{
    public function testConnection()
    {
        $connection = Database::connect();
        $this->assertNotNull($connection);
    }
}
