<?php
// error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
// session_start();
include('header_novo.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
include('conexao.php');
$datahora = (date('Y-m-d H:i:s'));

$id_pacote = $_POST['id_pacote'];

$update = "UPDATE `expedicao_recebido` SET `deleted_at` = '$datahora' WHERE `expedicao_recebido`.`id` =  '$id_pacote' ;";

$recebidos = mysqli_query($conexao, $update);

 echo '<meta http-equiv="refresh" content="0;URL=recebido_romaneio.php" />';


?>
