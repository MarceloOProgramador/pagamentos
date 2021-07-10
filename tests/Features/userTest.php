<?php declare(strict_types = 1);

namespace Test\Features;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    
    public function testCreate()
    {
        $userController = new UserController();

        $user = [
            "nome"      => "Andressa Alves",
            "senha"      => "1452587",
            "email"     => "andressaalves@gmail.com",
            "documento"  => "14785236547",
            "tipo"      => "lojista"
        ];

        $this->assertEquals(json_encode(["success", "Usuario criado com sucesso!"]), $userController->store($user));
    }

    public function testUpdate()
    {
        $userController = new UserController();

        $user = [
            "nome" => "Marcelo Updated",
            "email" => "marcelopereira@gmail.com",
            "senha" => "258963"
        ];
        
        $this->assertJson($userController->update(16, $user));
    }

    public function testDelete()
    {
        $userController = new UserController();
        $this->assertEquals($userController->delete(16), json_encode(["success", "Usuario deletado com sucesso!"]));
    }

    public function testPix()
    {
        $userController = new UserController();

        return $this->assertEquals($userController->sendTo(26, 100, 27), json_encode(["message" => "Success"]));
    }
}