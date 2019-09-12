<?php
session_start();
$verifyToken = false;

if(isset($_SESSION['token'])){
    include 'src/token.php';
    include 'src/database.php';
    $classToken = new Token();
    $queries = new Database();

    //VALIDAR TOKEN
    $verifyToken = $classToken->setTokenAss($_SESSION['token'], 'sematec');
}
?>
<!doctype html>
<html lang="pt-br">
<head> 
	<meta charset="utf-8" />
	<link rel="icon" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Agenda</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Light Bootstrap Table core CSS -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!-- Minha CSS -->
    <link href="assets/css/style.css" rel="stylesheet"/>
    <!-- Font Awesome 4.7.0 -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <?php
    echo '<div class="wrapper">';
    if($verifyToken === true){
        //DESCRIPTOGRAFAR TOKEN
        $tokenDecode = $classToken->setTokenDecode($_SESSION['token'], 'sematec', ['alg' => 'HS256','typ' => 'JWT']);
        $sqlUser = $queries->setSelect('*','accounts',"NCODUSER = {$tokenDecode->coduser}");
        $dataUser = $sqlUser->fetch();
        include 'pages/headers/headerVertic.php';
        echo '<div class="main-panel">';
        include 'pages/headers/headerHoriz.php';
        if (isset($_GET['url'])){
            if(($_GET['url']) == 'login'){
                $url = 'home';
            }
            else{
                $url = $_GET['url'];
            }
            if(!file_exists("pages/".$url.".php")){
                $url = '404';
            }
            include("pages/".$url.".php");
        }else{
            include("pages/home.php");
        }
        echo '</div>';
    }else{
        include("pages/login.php");
    }
    echo '</div>';
    ?>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Minhas functions  -->
	<script src="assets/js/funcs.js"></script>
</body>

</html>
