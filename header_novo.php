<!DOCTYPE html>
<?php
include('verifica_login.php');
date_default_timezone_set('America/Sao_Paulo');
//session_start();
//echo(date('H:i:s d-m-Y'));
$datahora = (date('H:i:s d-m-Y'));

?>
<html>

<head>
  <link rel="shortcut icon"  href="./images-on-off/paytec.ico"><!--este comando muda o icone da janela-->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, ;
        }

        .header {
            background-color: #f1f1f1;
            padding: 20px 10px;
            height: 90px;
        }

        .header a {
            float: left;
            color: black;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 9px;
            border-radius: 50px;
        }

        .header a.logo {
            font-size: 15px;
            font-weight: bold;
        }

        .header a:hover {
            background-color: #ddd;
            color: black;
        }

        .header a.active {
            background-color: dodgerblue;
            color: white;
        }

        .header-right {
            float: right;
        }

        @media screen and (max-width: 500px) {
            .header a {
                float: none;
                display: block;
                text-align: left;
            }

            .header-right {
                float: none;
            }
        }

        .dropbtn {
            background-color: #B0C4DE;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            text-align: left;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #4682B4;
        }

        .input-default {
            padding: .3rem .5rem;
            border-radius: 3px;
            border: 1px solid gray;
            outline: none !important;
        }

        .input-default:focus {
            border-color: #1e90ff;
        }

        div.a {
            text-align: center;

        }
    </style>
</head>

<body>
    <div class="header">
        
        <a class="logo"><img src="./images-on-off/paytec_3.jpeg" height="30" width="100"> <br>
            <br>
            Usuário: <?php echo $_SESSION['usuario']; ?> </a>
            
        <div class="a">

            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Produção
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- <a class="dropdown-item" href="dymo.php">Etiqueta SAMSUNG</a> -->
                    <a class="dropdown-item" href="destino.php">Produção</a>
                    <!-- <a class="dropdown-item" href="receber_pcp.php">Receber PCP</a>
                    <a class="dropdown-item" href="gerenciar.php">Gerenciar</a>
                    <a class="dropdown-item" href="importar_csv_95.php">Importar CSV</a>
                    <a class="dropdown-item" href="pesquisar.php">Pesquisar</a> -->
                    <a class="dropdown-item" href="logout.php">Sair</a>
                </div>
            </div>
        </div>
    </div>