<?php
    //INICIA A SESSÃO
    session_start();
    
    //INCLUDE CLASS
    include 'login.php';
    include 'token.php';
    include 'database.php';
    $queries = new Database();

    //LOGIN NO SISTEMA
    if((isset($_POST['code'])) && (isset($_POST['pass']))){
        
        $code = filter_var($_POST['code'], FILTER_SANITIZE_STRING);
        $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

        $login = new Login("$code", "$pass");
        $entrar = $login->setAuth();

        if($entrar == true){
            $_SESSION['CODUSER'] = 1;
            //CRIA TOEKN JWT
            $verifyToken = new Token();
            $encodeToken = $verifyToken->setTokenEncode(  [
                                                'alg' => 'HS256',
                                                'typ' => 'JWT'
                                            ],
                                            [
                                                'coduser' => $entrar['coduser'],
                                                'name' => $entrar['name'],
                                                'login' => $entrar['login'],
                                                'email' => $entrar['email']
                                            ],
                                            'sematec'
                                        );
            $_SESSION['token'] = "$encodeToken";
            echo 1;
        }
    }
    //------------------------------------------------------------------------------------

    //LOGOUT
    if(isset($_POST['logout'])){
        $logout = filter_var($_POST['logout'], FILTER_VALIDATE_BOOLEAN);
        if($logout == true){
            unset($_SESSION['CODUSER'], $_SESSION['token']);
            echo 1;
        }
    }

    //------------------------------------------------------------------------------------
    //VALIDANDO TOKEN
    if(isset($_GET['token'])){
        $verifyToken = new Token();
        $resultVerify = $verifyToken->setTokenAss($_GET['token'], 'sematec');
        if ($resultVerify == true){
            echo "TOKEN VÁLIDO";
        }
    }

    //------------------------------------------------------------------------------------
    //INCLUIR NOVO CONTATO
    if(isset($_POST['insertContact'])){

        $nameContact = filter_var($_POST['nameContact'], FILTER_SANITIZE_STRING);
        $nameCompany = filter_var($_POST['nameCompany'], FILTER_SANITIZE_STRING);
        $numTel = preg_replace('~[()-]~', '', $_POST['numTel']);
        $numTel = filter_var(trim($numTel), FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $nameOffice = filter_var($_POST['nameOffice'], FILTER_SANITIZE_STRING);

        if(($nameContact != '') && ($nameCompany != '') && (strlen($numTel) >= 10) && ($email != '') && ($nameOffice != '')){
            if(isset($_FILES['newImg']['name']) && $_FILES["newImg"]["error"] == 0){

                $array = array('.');
                $string = $_FILES['newImg']['name'];
                foreach ($array as $letra) {
                    $letras[$letra] = substr_count($string, $letra);
                }
                // Verifica duas extensões
                if ($letras['.'] <= 1){

                    $arquivo_tmp = $_FILES['newImg']['tmp_name'];
                    $nomeArquivo = $_FILES['newImg']['name'];

                    // Pega a extensao
                    $extensao = strrchr($nomeArquivo, '.');

                    // Converte a extensao para minusculo
                    $extensao = strtolower($extensao);

                    // Somente imagens, .jpg;.jpeg;.gif;.png
                    if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
                    {   
                        $novoNome = md5(microtime()) . $extensao;
                        $destino = '../assets/img/imgsContact/' . $novoNome; 
                        if( move_uploaded_file( $arquivo_tmp, $destino)){
                            
                        }
                        else{
                            echo json_encode(1);
                        }
                    }
                    else{
                        echo json_encode(2);
                    }
                }else{
                    echo json_encode(2);
                }
            }
            if(!isset($novoNome)){
                $novoNome = "";

            }
            $insertData = $queries->setInsert('contacts',
                                    'CNAME, CEMPRESA, NTEL, CIMG, CCARGO, CEMAIL, NCODUSER',
                                    "'$nameContact', '$nameCompany', '$numTel', '$novoNome', '$nameOffice', '$email', {$_SESSION['CODUSER']}");
                echo json_encode(0);
        }else{
            echo json_encode(10);
        }
    }
    
    //------------------------------------------------------------------------------------
    //MOSTRAR MODAL CONTATOS
    if(isset($_POST['codContactsModal'])){
        $codContact = filter_var($_POST['codContactsModal'], FILTER_VALIDATE_INT);
        $queryContact = $queries->setSelect('*','contacts',"NCODCONTACT = {$codContact}");
        $dataContact = $queryContact->fetch();
        if(isset($queryContact)){
            echo json_encode($dataContact);
        }
    }

    //------------------------------------------------------------------------------------
    //ATUALIZAR CONTATO
    if(isset($_POST['updateContact'])){

        $nameContact = filter_var($_POST['nameContact'], FILTER_SANITIZE_STRING);
        $nameCompany = filter_var($_POST['nameCompany'], FILTER_SANITIZE_STRING);
        $numTel = preg_replace('~[()-]~', '', $_POST['numTel']);
        $numTel = filter_var(trim($numTel), FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $nameOffice = filter_var($_POST['nameOffice'], FILTER_SANITIZE_STRING);
        $codContact = filter_var($_POST['codContact'], FILTER_VALIDATE_INT);

        $queryContact = $queries->setSelect('CIMG','contacts',"NCODCONTACT = {$codContact}");
        $dataContact = $queryContact->fetch();

        if(($nameContact != '') && ($nameCompany != '') && (strlen($numTel) >= 10) && ($email != '') && ($nameOffice != '') && ($codContact != '')){
            if(isset($_FILES['newImg']['name']) && $_FILES["newImg"]["error"] == 0){

                $array = array('.');
                $string = $_FILES['newImg']['name'];
                foreach ($array as $letra) {
                    $letras[$letra] = substr_count($string, $letra);
                }
                if ($letras['.'] <= 1){

                    $arquivo_tmp = $_FILES['newImg']['tmp_name'];
                    $nomeArquivo = $_FILES['newImg']['name'];

                    // Pega a extensao
                    $extensao = strrchr($nomeArquivo, '.');

                    // Converte a extensao para minusculo
                    $extensao = strtolower($extensao);

                    // Somente imagens, .jpg;.jpeg;.gif;.png
                    if(strstr('.jpg;.jpeg;.gif;.png', $extensao))
                    {   
                        $novoNome = md5(microtime()) . $extensao;
                        $destino = '../assets/img/imgsContact/' . $novoNome; 
                        if( move_uploaded_file( $arquivo_tmp, $destino)){

                            unlink("../assets/img/imgsContact/".$dataContact['CIMG']);
                        }
                        else{
                            echo json_encode(1);
                        }
                    }
                    else{
                        echo json_encode(2);
                    }
                }else{
                    echo json_encode(2);
                }
            }
            if(!isset($novoNome)){
                $novoNome = $dataContact['CIMG'];
            }
            $insertData = $queries->setUpdate('contacts',
                                    "CNAME = '$nameContact', CEMPRESA = '$nameCompany', NTEL = '$numTel', CIMG = '$novoNome', CCARGO = '$nameOffice', CEMAIL = '$email'",
                                    "NCODCONTACT = $codContact");
            if(isset($insertData)){
                echo json_encode(0);
            }
        }else{
            echo json_encode(10);
        }

    }
    
    //------------------------------------------------------------------------------------
    //EXCLUIR CONTATO
    if(isset($_POST['deleteContact'])){

        $codContact = filter_var($_POST['codContact'], FILTER_VALIDATE_INT);
        
        $queryContact = $queries->setSelect('CIMG','contacts',"NCODCONTACT = {$codContact}");
        $dataContact = $queryContact->fetch();

        unlink("../assets/img/imgsContact/".$dataContact['CIMG']);

        $deleteData = $queries->setDelete('contacts',
                                    "NCODCONTACT = $codContact");
        if(isset($deleteData)){
            echo json_encode(0);
        }

    }