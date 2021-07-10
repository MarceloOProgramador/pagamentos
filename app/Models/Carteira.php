<?php declare(strict_types = 1);

namespace App\Models;
use Mcldb\Classes\Update;
use PDO;
use PDOException;

class Carteira extends Model
{
    /**
     * This method save transaction in database
     * 
     * @var array $payer_wallet
     * @var array $payee_wallet
     * 
     * @return bool
     */
    public function toTransfer(array $payer_wallet, array $payee_wallet) : bool
    {
        try{

            $update = new Update();
            $update->getInstance()->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
            $update->getInstance()->beginTransaction();
            $this->find((int) $payer_wallet["id"]);
            $this->update($payer_wallet);
            $this->find((int) $payee_wallet["id"]);
            $this->update($payee_wallet);
            $update->getInstance()->commit();
            return true;

        }catch(PDOException $e){

            $update->getInstance()->rollBack();
            throw new PDOException($e->getMessage(), $e->getCode());
            return false;
            
        }
    }
}