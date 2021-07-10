<?php declare(strict_types = 1);

namespace App\Models;

use Mcldb\Classes\Read;

class User extends Model{
   
    public function carteira()
    {
        $read = new Read();
        $read->toRead("carteiras")->where("usuario_id", "=", "{$this->id}");
        if(!empty($read->fetch()))
            $this->datas["carteira"] = $read->fetch()[0];
        return $this;
    }
}