<?php

namespace App\Controllers;

use App\Models\Carteira;
use App\Models\User;

class UserController implements Controller{
    /**
     * Index get all users
     * @return array
     */
    public function index()
    {
        $user = new User("usuarios");
        $users = $user->all();
        echo json_encode(["users" => $users]);
    }

    
    /**
     * Method show get one user
     * @var int $id
     * @return array
     */
    public function show(int $id)
    {
        $user = new User("usuarios");
        $user->find($id);
        $user->carteira();
        echo json_encode(["user" => $user->datas]);
    }

    /**
     * Store save the user datas in db
     * @var array $datas
     * @return array
     */
    public function store(array $datas)
    {
        $stored = FALSE;
        $user = new User("usuarios");
        $wallet = new Carteira("carteiras");
        $stored = $user->save($datas);
        
        if($stored){
            $wallet_stored = false;
            $wallet_stored = $wallet->save(["usuario_id" => $user->last_insert]);

            if(!$wallet_stored)
            {
                http_response_code(500);
                echo json_encode(["error", "Carteira do usuario nao foi criada"]);
            }

            echo json_encode(["success", "Usuario criado com sucesso!"]);
        }          
        else
            echo json_encode(["error", "Usuario não criado com sucesso!"]);
    }

    /**
     * Update method update datas to specific user 
     * @var int $id
     * @var array $datas
     * @return array
     */
    public function update(int $id, array $datas)
    {
        $updated = FALSE;
        $user = new User("usuarios");
        $user->find($id);
        $updated = $user->update($datas);

        if($updated)
            echo json_encode(["success", "Usuario atualizado com sucesso!"]);
        else{
            http_response_code(500);
            echo json_encode(["error", "Usuario não atualizado com sucesso!"]);
        }
            
    }

    /**
     * Delete method destroy a specificy db user
     * 
     * @var int $id
     * @return array
     */
    public function delete(int $id)
    {
        $deleted = FALSE;
        $user = new User("usuarios");
        
        $deleted = $user->find($id)->delete();

        if($deleted)
            echo json_encode(["success" => "Usuario deletado com sucesso!"]);
        else
        {
            http_response_code(500);
            echo json_encode(["error" =>"Usuario não deletado com sucesso!"]);
        }
    }

    /**
     * This Method create a curl
     * @var CURL $ch
     * @var string $url
     * @return CURL 
     */
    public function curlInitialize(&$ch, $url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        return $ch;
    }

    /**
     * This method check if user have authorizatio
     * @return bool
     */
    public function toCheckAuthorization() : bool
    {
        $url = "https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6";
        $ch = null;
        $this->curlInitialize($ch, $url);

        $result = json_decode(curl_exec($ch));

        if($result->message == "Autorizado")  
            return true;
        else
            return false;
    }

    /**
     * This method send a confimation trasaction email
     * @return json_encode $response
     */
    public function sendConfirmationMail()
    {
        $url = "http://o4d9z.mocklab.io/notify";
        $ch = null;
        $this->curlInitialize($ch, $url);
        
        $response = json_decode(curl_exec($ch), true);
        return $response;
    }

    /**
     * This Method prepare the datas users's wallet to transaction
     * @return void
     */
    public function sendTo()
    {
        
        $payload = filter_input_array(INPUT_POST, FILTER_SANITIZE_ENCODED)["payload"];

        $user_payer = new User("usuarios");
        $user_payee = new User("usuarios");
        
        $user_payer->find($payload["payer_id"]);
        $user_payer->carteira();

        $user_payee->find($payload["payee_id"]);
        $user_payee->carteira();

        if(!empty($user_payer->datas) && !empty($user_payee->datas))
        {
            if($user_payer->datas["carteira"]["saldo"]){

                if($user_payer->datas["tipo"] != "lojista")
                {
                    $wallet = new Carteira("carteiras");
                    $user_payer->datas["carteira"]["saldo"] -= $payload["value"];
                    $user_payee->datas["carteira"]["saldo"] += $payload["value"];
    
                    if($this->toCheckAuthorization())
                        if($wallet->toTransfer($user_payer->datas["carteira"], $user_payee->datas["carteira"]))
                            echo json_encode($this->sendConfirmationMail());                        
                        else
                        {
                            http_response_code(500);
                            echo json_encode(["error" => "Transferencia nao realizada!"]);
                        }
                    else
                    {
                        http_response_code(500);
                        echo json_encode(["error" => "Nao autorizado!"]);
                    }
                }else
                {
                    http_response_code(500);
                    echo json_encode(["error" => "Conta do tipo lojista, nao autorizado!"]);
                }
            }else
            {
                http_response_code(500);
                echo json_encode(["error" => "Saldo invalido"]);
            }
        }else{
            http_response_code(404);
            echo json_encode(["error" => "Payer or Payee not found!"]);
        }

    }
}