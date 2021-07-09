<?php

namespace App\Controllers;

use App\Models\Carteira;
use App\Models\User;

header('Content-Type: application/json; charset: utf-8');

class UserController implements Controller{

    public function index()
    {
        $user = new User("usuarios");
        $users = $user->all();
        return json_encode(["users" => $users]);
    }

    public function show(int $id)
    {
        $user = new User("usuarios");
        $user->find($id);
        $user->carteira();

        return json_encode(["user" => $user->datas]);
    }

    public function store(array $datas)
    {
        $stored = FALSE;
        $user = new User("usuarios");
        $wallet = new Carteira("carteiras");
        $stored = $user->save($datas);
        
        if($stored){
            $wallet_stored = false;
            $wallet_stored = $wallet->save(["usuario_id" => $user->last_insert]);

            if(!$wallet_stored)
                return json_encode(["error", "Carteira do usuario nao foi criada"]);

            return json_encode(["success", "Usuario criado com sucesso!"]);
        }          
        else
            return json_encode(["error", "Usuario não criado com sucesso!"]);
    }

    public function update(int $id, array $datas)
    {
        $updated = FALSE;
        $user = new User("usuarios");
        $user->find($id);
        $updated = $user->update($datas);

        if($updated)
            return json_encode(["success", "Usuario atualizado com sucesso!"]);
        else
            return json_encode(["error", "Usuario não atualizado com sucesso!"]);
    }

    public function delete(int $id)
    {
        $deleted = FALSE;
        $user = new User("usuarios");
        
        $deleted = $user->find($id)->delete();

        if($deleted)
            return json_encode(["success", "Usuario deletado com sucesso!"]);
        else
            return json_encode(["error", "Usuario não deletado com sucesso!"]);
    }

    public function sendTo()
    {
        
    }
}