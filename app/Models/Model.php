<?php declare(strict_types = 1);

namespace App\Models;

use PDOException;
use Mcldb\Classes\Create;
use Mcldb\Classes\Delete;
use Mcldb\Classes\Read;
use Mcldb\Classes\Update;

class Model {

    protected string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function save(array $datas) : bool
    {
        try
        {
            $create = new Create();
            $create->toCreate($this->table, $datas);
            return $create->exec();
        }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function update(array $datas, int $id): bool
    {
        try
        {
            $update = new Update();

            $update->toUpdate($this->table, $datas)->where("id", "=", "{$id}");
            $update->exec();
            
            return true;
        }catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try{
            $delete = new Delete();
            $delete->toDelete($this->table)->where("id", "=", "{$id}");
            $delete->exec();
            return true;
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function find($id) : array
    { 
        $read = new Read();
        $datas = $read->toRead($this->table)->fetch()[0];
        return $datas;
    }

    public function all() : array
    {
        $read = new Read();
        $datas = $read->toRead($this->table)->fetch();
        return $datas;
    }
}