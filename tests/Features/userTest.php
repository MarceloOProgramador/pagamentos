<?php declare(strict_types = 1);

namespace Test\Features;

use PHPUnit\Framework\TestCase;
use Mcldb\Classes\Connection;

class ConnectTest extends TestCase {
    
    public function testConnect()
    {
        $connect = new Connection("mysql", "root", "root", "CRUD");
        
        return $this->assertIsObject($connect->getInstance());
    }
}