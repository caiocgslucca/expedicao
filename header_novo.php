<!DOCTYPE html>
<html lang=pt-BR>
<?php
include('verifica_login.php');
date_default_timezone_set('America/Sao_Paulo');
//session_start();
//echo(date('H:i:s d-m-Y'));
$datahora = (date('H:i:s d-m-Y'));

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon"  href="./images-on-off/on.ico"><!--este comando muda o icone da janela-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="header">
        <a class="logo"><img src="./images-on-off/logo_viavareja.jpeg" height="40" width="90"> <br>
            <br>
            Usuário: <?php echo $_SESSION['usuario']; ?> </a>
            
        <div class="a">

            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    MENU
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- <a class="dropdown-item" href="dymo.php">Etiqueta SAMSUNG</a> -->
                    <a class="dropdown-item" href="receber.php">Receber Pacote</a>
                    <!-- <a class="dropdown-item" href="receber_pcp.php">Receber PCP</a> -->
                    <!-- <a class="dropdown-item" href="gerenciar.php">Gerenciar</a> -->
                    <a class="dropdown-item" href="importar_csv.php">Importar CSV</a>
                    <!-- <a class="dropdown-item" href="pesquisar.php">Pesquisar</a> -->
                    <a class="dropdown-item" href="logout.php">Sair</a>
                </div>
            </div>
            
        </div>
        
    </div>