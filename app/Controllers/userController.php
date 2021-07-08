<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;

class UserController extends Controller{

    public function index()
    {

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
        $updated = $user->update($datas, $id);

        if($updated)
            return json_encode(["success", "Usuario atualizado com sucesso!"]);
        else
            return json_encode(["error", "Usuario não atualizado com sucesso!"]);
    }

    public function delete(int $id)
    {

    }
}