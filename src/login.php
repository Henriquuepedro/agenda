<?php

class Login{

    private $login = "";
    private $pass = "";

    public function __construct(string $login, string $pass)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public function setAuth()
    {
        return $this->getAuth();
    }

    public function getAuth():array
    {       
        if(strlen($this->login) < 6){
            throw new Exception('Nome de usuário ou senha inválidos!');
        }
        if(strlen($this->pass) < 6){
            throw new Exception('Nome de usuário ou senha inválidos!');
        }
        $cn = new Conexao();
        $con = $cn->connect();
        $sql = $con->query("SELECT * FROM accounts WHERE `CPASSWORD` = '{$this->pass}' AND `CLOGIN` = '{$this->login}'");
        $resultAuth = $sql->rowCount();
        if($resultAuth != 1){
            throw new Exception('Nome de usuário ou senha inválidos!');
        }
        $resultData = $sql->fetch();
        return  [
                    'coduser' => $resultData['NCODUSER'],
                    'name' => $resultData['CNAME'],
                    'login' => $resultData['CLOGIN'],
                    'email' => $resultData['CEMAIL']
                ];
    }
    
}




?>