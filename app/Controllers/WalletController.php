<?php declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Carteira;

class WalletController implements Controller{
    /**
     * This method list all datas
     * @return void
     */
    public function index() : void
    {
        $wallet = new Carteira("carteiras");
        $wallets = $wallet->all();
        echo json_encode($wallets);
    }

    /**
     * This method search a specific entity
     * @var int $id
     * @return void
     */
    public function show (int $id) : void
    {
        $wallet = new Carteira("carteiras");
        $wallet_datas = $wallet->find($id);

        if(!empty($wallet_datas))
        {
            http_response_code(404);
            echo json_encode(["error" => "Carteira nao encontrada!"]);
        }
        else
            echo json_encode($wallet_datas);
    }

    /**
     * This method persist datas in db
     * @var array $datas
     */
    public function store(array $datas)
    {
        $wallet = new Carteira("carteiras");
        $stored = false;
        $stored = $wallet->save($datas);

        if($stored)
            echo json_encode(["success" => "Carteira registrada com sucesso!"]);
        else
        {
            http_response_code(500);
            echo json_encode(["error" => "Carteira nao registra com sucesso!"]);
        }
    }

    /**
     * This method updata a specific wallet's datas in database
     * 
     * @var int $id
     * @var array $datas
     * 
     * @return void
     */
    public function update(int $id, array $datas) : void
    {
        $wallet = new Carteira("carteiras");
        $updated = false;
        $wallet->find($id);
        $updated = $wallet->update($datas);

        if($updated)
            echo json_encode(["success", "Carteira atualizada com sucesso!"]);
        else{
            http_response_code(500);
            echo json_encode(["error", "Carteira nao atualiza com successo!"]);
        }
    }

    /**
     * This method delete a specific entity in database
     * 
     * @var int $id
     * 
     * @return void
     */
    public function delete(int $id) : void
    {
        $wallet = new Carteira("carteiras");
        $deleted = false;
        $deleted = $wallet->find($id)->delete();
        
        if($deleted)
            echo json_encode(["success", "Carteira deletada com sucesso!"]);
        else{
            http_response_code(500);
            echo json_encode(["error", "Carteira nao deletada com sucesso!"]);
        }
            
    }
}