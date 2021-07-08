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
            "nome"      => "Andressa Alves",
            "senha"      => "147258",
            "email"     => "andressaalvesantos@gmail.com",
            "documento"  => "41064856657",
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

    // public function testShow()
    // {
    //     $userController = new UserController();
    //     var_dump($userController->show(16));
    //     die;
    // }
}