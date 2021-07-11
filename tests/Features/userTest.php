<?php declare(strict_types = 1);

namespace Test\Features;

use App\Controllers\UserController;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    
    public function testCreate()
    {
        $userController = new UserController();

        $user = [
            "nome"      => "Luiz Felipe",
            "senha"      => "147852",
            "email"     => "luuiz.fee@gmail.com",
            "documento"  => "14735236557",
            "tipo"      => "comum"
        ];
        $url = "http://www.localhost/desafio-picpay/transaction";

        $response = file_get_contents($url);
        $s = json_decode($response);
        //$this->assertFileEquals();
    }

    public function testUpdate()
    {
        $userController = new UserController();

        $user = [
            "nome" => "Marcelo Updated",
            "email" => "marcelopereira@gmail.com",
            "senha" => "258963"
        ];
        
        //$this->assertJson($userController->update(16, $user));
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