<?php declare(strict_types = 1);

namespace App\Controllers;

abstract class Controller{

    abstract public function index();

    abstract function store(array $datas);

    abstract function update(int $id, array $datas);

    abstract function delete(int $id);
}