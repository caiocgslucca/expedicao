<?php
// error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
// session_start();
include('header_novo.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
include('conexao.php');
$datahora = (date('Y-m-d H:i:s'));

// print_r($_POST);
// die();
$pedido = $_POST['pedido'];

$sql_finalizar_recebido = ("UPDATE `pcp_recebido` SET `deleted_at` = '$datahora' where `pcp_recebido`.`pedido` =  '$pedido' ");
$finalizar_recebido = mysqli_query($conexao, $sql_finalizar_recebido);

$sql_finalizar_db = ("UPDATE `db` SET `deleted_at` = '$datahora' where `db`.`pedido` =  '$pedido' ");
$finalizar_recebidos = mysqli_query($conexao, $sql_finalizar_db);

echo '<meta http-equiv="refresh" content="0;URL=recebido.php" />';


?>
