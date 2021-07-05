<?php declare(strict_types = 1);

namespace App\Controllers;

abstract class Controller{

    abstract public function index();

    abstract function store(array $datas);

    abstract function update(array $datas, int $id);

    abstract function delete(int $id);
}