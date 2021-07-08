<?php

namespace App\Controllers;

use App\Models\User;

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
        $stored = $user->save($datas);
        if($stored)
            return json_encode(["success", "Usuario criado com sucesso!"]);
        else
            return json_encode(["error", "Usuario não criado com sucesso!"]);
    }

    public function update(int $id, array $datas)
    {
        $updated = FALSE;
        $user = new User("usuarios");
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
        
        $deleted = $user->delete($id);

        if($deleted)
            return json_encode(["success", "Usuario deletado com sucesso!"]);
        else
            return json_encode(["error", "Usuario não deletado com sucesso!"]);
    }
}