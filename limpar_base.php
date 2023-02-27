<?php
include('conexao.php');
include('verifica_login.php');
date_default_timezone_set('America/Recife');
include('Header_CSS_JS.php');
$datahora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['usuario'];
$status = 1;

$sql_delet_db = "DELETE from db where finalizado is null";
$conexao_db = mysqli_query($conexao, $sql_delet_db);

$sql_delet_pcp_recebido = "DELETE from pcp_recebido where finalizado is null;";
$conexaop_cp_recebido = mysqli_query($conexao, $sql_delet_pcp_recebido);

                    ?>  
                    <div class="alert alert-danger" role="alert" style="text-align: center;"> <h2><b>Base Apagada</b></h2></div> 
                    <?php
                       echo '<meta http-equiv="refresh" content="2;URL=importar_csv.php" />';