<?php
session_start();
include 'token.php';
include 'database.php';
$classToken = new Token();
$queries = new Database();

$verifyToken = $classToken->setTokenAss($_SESSION['token'], 'sematec');
if($verifyToken === true){
    //DESCRIPTOGRAFAR TOKEN
    $result = $_GET['result'];
    $tokenDecode = $classToken->setTokenDecode($_SESSION['token'], 'sematec', ['alg' => 'HS256','typ' => 'JWT']);
    $queryContacts = $queries->setSelect('*','contacts',"NCODUSER = {$tokenDecode->coduser} AND (CNAME LIKE UPPER('%$result%') OR NTEL LIKE UPPER('%$result%') OR CEMPRESA LIKE UPPER('%$result%'))");

    if(($queryContacts->rowCount() != 0 )){
            while($dataContacts = $queryContacts->fetch()){
            echo '
            <div class="col-md-3">
                <div class="card card-user">
                    <div class="image">
                        <img src="assets/img/fundoContato.jpg" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <a>
                                <img class="avatar border-gray" src="assets/img/imgsContact/'.$dataContacts['CIMG'].'"/>

                                <h4 class="title">'.$dataContacts['CNAME'].'<br />
                                    <small>'.$dataContacts['NTEL'].'</small>
                                </h4>
                            </a>
                        </div>
                        <p class="description text-center">"'.$dataContacts['CEMPRESA'].'"</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-simple" data-toggle="modal" data-target="#updateContact" value="'.$dataContacts['NCODCONTACT'].'" onclick="showDataModal(this.value)"><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>';
            }
    }else{
        echo "<h4 align='center'>Nenhum contato encontrado</h4>";
    }
}
?>
