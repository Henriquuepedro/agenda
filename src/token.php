<?php

class Token{

    private $token = "";
    private $pass = "";
    private $header = [];
    private $payload = [];

    public function __construct(){}

    // VERIFICA SE A ASSINATURA É CORRETA
    public function setTokenAss(string $token, string $pass)
    {
        $this->token = $token;
        $this->pass = $pass;
        return $this->getTokenAss();
    }

    public function getTokenAss():bool
    {   
        $token = explode(".",$this->token);
        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];
        
        $valid = hash_hmac('sha256',"$header.$payload","$this->pass",false);
        $valid = base64_encode($valid);
        
        if($signature != $valid){
            throw new Exception("Sua assinatura está inválida!");
        }
        return true;
        
    }
    //------------------------------------------------------------------------------------

    // CRIA O TOKEN JWT
    public function setTokenEncode(array $header, array $payload, string $pass)
    {
        $this->header = $header;
        $this->payload = $payload;
        $this->pass = $pass;
        return $this->getTokenEncode();
    }

    public function getTokenEncode(): string
    {
        $header = json_encode($this->header);
        $header = base64_encode($header);
    
        $payload = json_encode($this->payload);
        $payload = base64_encode($payload);
    
        $signature = hash_hmac('sha256',"$header.$payload",'sematec',false);
        $signature = base64_encode($signature);
        return "$header.$payload.$signature";
        
    }
    //------------------------------------------------------------------------------------

    //DESCRIPTOGRAFA A TOKEN
    public function setTokenDecode(string $token, string $pass, array $allowed_algs = array())
    {
        $this->token = $token;
        $this->pass = $pass;
        return $this->getTokenDecode();
    }

    public function getTokenDecode()
    {
        if (empty($this->pass)) {
            throw new Exception('Sua chave está vázia');
        }
        $token = explode('.', $this->token);
        if (count($token) != 3) {
            throw new Exception('Numero de argumentos inválido');
        }
        $head = $token[0];
        $body = $token[1];
        $crypt = $token[2];

        $signature = hash_hmac('sha256',"$head.$body","$this->pass",false);
        $signature = base64_encode($signature);

        if ($signature != $crypt) {
            throw new Exception('Sua chave de autenticação está incorreta');
        }
        $header = json_decode(base64_decode($head));
        $payload = json_decode(base64_decode($body));


        return $payload;
        
    }
    //------------------------------------------------------------------------------------
}