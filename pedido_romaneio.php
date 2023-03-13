<?php
// include('manutencao.html');
// exit();

include('verifica_login.php');
// session_start();
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
// include('heder_estacao.php');
$usuario = $_SESSION['usuario'];
$estacao = $_SESSION['estacao'][0];


date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');

$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));


$qtd = 0;
$id_status = 1;
?>
<!doctype html>
<html lang=pt-BR>
<div style="padding-left:15px">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pesquisar</title>
    </head>
<hr>
<form action="result_pesquisa_romaneio.php" method="GET">

    <div class="flex-center flex-column">
        <!-- Grid column -->
        <div class="col-2">
            <!-- Material input -->
            <!-- <div class="md-form mt-0">
                <input  name="ordem" autocomplete="off" type="text" id="form1" class="form-control">
                <label for="form1"><b>Ordem</b> </label>
            </div> -->
        </div> 
    </div>
    <div class="flex-center flex-column">
        <!-- Grid column -->
        <div class="col-2">
            <!-- Material input -->
            <div class="form-group shadow-textarea text-center">
                <!-- <label for="exampleFormControlTextarea6"><b>Pacote</b></label> -->
                <input placeholder="Bipar PEDIDO" name="pedido" value="" autofocus class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></input>
            </div>
        </div> 
    </div>
    <div class="flex-center flex-column">
                <div class="col-2">
                </div>
                <div class="col-2">
                    <div class="md-form mt-0">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </div>
</form>
</div>
