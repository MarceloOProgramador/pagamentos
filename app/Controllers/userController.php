<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\User;

class UserController extends Controller{
    private $user;

    public function UserController ()
    {
        $this->setUser(new User());
    }

    public function index()
    {

    }

    public function store(array $datas)
    {
        $stored = FALSE;
        $stored = $this->getUser()->save($datas);

        if($stored)
            return json_encode(["success", "Usuario criado com sucesso!"]);
        else
            return json_encode(["error", "Usuario não criado com sucesso!"]);
    }

    public function update(array $datas, int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function setUser(User $user) : void
    {
        $this->user = $user;
    }

    public function getUser() : User
    {
        return $this->user;
    }
}