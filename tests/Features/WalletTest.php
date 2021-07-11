<?php declare(strict_types = 1);

namespace Test\Features;

namespace Test\Features;

use App\Controllers\CarteiraController;
use App\Models\Carteira;
use PHPUnit\Framework\TestCase;

class WalletTest extends TestCase {
    
    public function testCreate()
    {
        $carteiraController = new CarteiraController();

        $carteira = [
            "usuario_id" => 21
        ];

        $this->assertEquals(json_encode(["success", "Carteira registrada com sucesso!"]), $carteiraController->store($carteira));
    }

    public function testUpdate()
    {
        $carteiraController = new CarteiraController();

        $carteira = ["saldo" => 3000000];
        
        $this->assertEquals($carteiraController->update(2, $carteira), json_encode(["success", "Carteira atualizada com successo!"]));
    }

    public function testDelete()
    {
        $carteiraController = new CarteiraController();
        $this->assertEquals($carteiraController->delete(2), json_encode(["success", "Carteira deletada com sucesso!"]));
    }
}