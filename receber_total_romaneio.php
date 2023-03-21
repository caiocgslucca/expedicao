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
$obs = $_POST['observacao'];


date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');

$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('Y-m-d 00:00:00'));
$datahorafinal = (date('Y-m-d 23:59:59'));


 $select = "INSERT INTO expedicao_recebido
( nro_documento
,nro_pedido
,nro_etiqueta
,dt_recebimento
,nro_romaneio_expedicao
,qtde_volumes
,qtde_itens
,`status`
,unidade_atual
,nome_pessoa_visita
,finalizado
,usuario
,data_hora
,deleted_at
,obs
)
SELECT producao.nro_documento
,producao.nro_pedido
,producao.nro_etiqueta
,producao.dt_recebimento
,producao.nro_romaneio_expedicao
,producao.qtde_volumes
,producao.qtde_itens
,producao.status
,producao.unidade_atual
,producao.nome_pessoa_visita
,NULL
,'$usuario'
,'$datahora'
,NULL
,'$obs'
FROM `expedicao` as producao 
LEFT OUTER JOIN `expedicao_recebido` as recebido on recebido.nro_etiqueta = producao.nro_etiqueta and recebido.deleted_at IS NULL and recebido.finalizado IS NULL
WHERE producao.deleted_at IS NULL and producao.finalizado IS NULL and recebido.nro_etiqueta is null;
";

// echo $select;
$_salvar = mysqli_query($conexao, $select);
echo '<meta http-equiv="refresh" content="0;URL=recebido_romaneio.php" />';
