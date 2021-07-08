<?php declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Carteira;

class CarteiraController implements Controller{

    public function index(){
        $carteira = new Carteira("carteiras");
        $carteiras = $carteira->all();
        return json_encode($carteiras);
    }

    public function show (int $id)
    {
        $carteira = new Carteira("carteiras");
        $cateira_datas = $carteira->find($id);
        if(!empty($cateira_datas))
            return json_encode(["error", "Carteira nao encontrada!"]);
        else
            return json_encode($cateira_datas);
            
    }

    public function store(array $datas)
    {
        $carteira = new Carteira("carteiras");
        $stored = false;
        $stored = $carteira->save($datas);

        if($stored)
            return json_encode(["success", "Carteira registrada com sucesso!"]);
        else
            return json_encode(["error", "Carteira não registra com sucesso!"]);
    }

    public function update(int $id, array $datas)
    {
        $carteira = new Carteira("carteiras");
        $updated = false;
        $carteira->find($id);
        $updated = $carteira->update($datas);

        if($updated)
            return json_encode(["success", "Carteira atualizada com sucesso!"]);
        else
            return json_encode(["error", "Carteira nao atualiza com successo!"]);
    }

    public function delete(int $id)
    {
        $carteira = new Carteira("carteiras");
        $deleted = false;
        $deleted = $carteira->find($id)->delete();
        
        if($deleted)
            return json_encode(["success", "Carteira deletada com sucesso!"]);
        else
            return json_encode(["error", "Carteira nao deletada com sucesso!"]);
    }
}