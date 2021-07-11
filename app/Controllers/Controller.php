<?php declare(strict_types = 1);

namespace App\Controllers;

interface Controller{

    public function index();

    public function show(int $id);

    public function store(array $datas);

    public function update(int $id, array $datas);

    public function delete(int $id);
}