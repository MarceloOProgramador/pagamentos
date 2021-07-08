<?php declare(strict_types = 1);

namespace Test\Features;

use App\Controllers\UserController;
use App\Models\User;
use PHPUnit\Framework\TestCase;
use Mcldb\Classes\Create;

class UserTest extends TestCase {
    
    public function testCreate()
    {
        $userController = new UserController();

        $user = [
            "nome"      => "Marcelo Pereira",
            "senha"      => "123456",
            "email"     => "marcelooprogramador@gmail.com",
            "documento"  => "44487780877",
            "tipo"      => "comum"
        ];

        $this->assertJson($userController->store($user));
    }

    public function testUpdate()
    {
        $userController = new UserController();

        $user = [
            "senha"      => "741589",
        ];
        
        $this->assertJson($userController->update(10, $user));
    }
}