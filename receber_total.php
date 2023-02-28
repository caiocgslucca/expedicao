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
$destino = $_POST['destino'];


date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');

$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('Y-m-d 00:00:00'));
$datahorafinal = (date('Y-m-d 23:59:59'));


 $select = "INSERT INTO pcp_recebido
( pacote, pedido, nota_fiscal, usuario, data_hora, obs)
SELECT producao.pacote, producao.pedido, producao.nota_fiscal, '$usuario', '$datahora', ''
FROM `db` as producao 
LEFT OUTER JOIN `pcp_recebido` as recebido on recebido.pacote = producao.pacote and recebido.deleted_at IS NULL and recebido.finalizado IS NULL
WHERE producao.deleted_at IS NULL and producao.finalizado IS NULL and recebido.pacote is null;
";

$_salvar = mysqli_query($conexao, $select);
echo '<meta http-equiv="refresh" content="0;URL=recebido.php" />';
