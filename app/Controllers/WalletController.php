<?php declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Carteira;

class WalletController implements Controller{

    public function index(){
        $wallet = new Carteira("carteiras");
        $wallets = $wallet->all();
        return json_encode($wallets);
    }

    public function show (int $id)
    {
        $wallet = new Carteira("carteiras");
        $wallet_datas = $wallet->find($id);
        if(!empty($wallet_datas))
            return json_encode(["error", "Carteira nao encontrada!"]);
        else
            return json_encode($wallet_datas);
            
    }

    public function store(array $datas)
    {
        $wallet = new Carteira("carteiras");
        $stored = false;
        $stored = $wallet->save($datas);

        if($stored)
            return json_encode(["success", "Carteira registrada com sucesso!"]);
        else
            return json_encode(["error", "Carteira não registra com sucesso!"]);
    }

    public function update(int $id, array $datas)
    {
        $wallet = new Carteira("carteiras");
        $updated = false;
        $wallet->find($id);
        $updated = $wallet->update($datas);

        if($updated)
            return json_encode(["success", "Carteira atualizada com sucesso!"]);
        else
            return json_encode(["error", "Carteira nao atualiza com successo!"]);
    }

    public function delete(int $id)
    {
        $wallet = new Carteira("carteiras");
        $deleted = false;
        $deleted = $wallet->find($id)->delete();
        
        if($deleted)
            return json_encode(["success", "Carteira deletada com sucesso!"]);
        else
            return json_encode(["error", "Carteira nao deletada com sucesso!"]);
    }
}