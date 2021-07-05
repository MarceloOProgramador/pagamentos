<?php declare(strict_types = 1);

namespace App\Models;

use Mcldb\Classes\Create;
use Mcldb\Classes\Read;
use Mcldb\Classes\Update;
use Mcldb\Classes\Delete;

class User {

    public function save(array $datas) : bool
    {
        $read = new Create(); 
        return true;
    }

}