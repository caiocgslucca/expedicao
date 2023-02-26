<?php
include('conexao.php');
include('verifica_login.php');
date_default_timezone_set('America/Recife');
include('Header_CSS_JS.php');
$datahora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['usuario'];
$status = 1;

$sql_delet = "DELETE from db where deleted_at is null";
                    $recebidos = mysqli_query($conexao, $sql_delet);
                    ?>  
                    <div class="alert alert-danger" role="alert" style="text-align: center;"> <h2><b>Base Apagada</b></h2></div> 
                    <?php
                       echo '<meta http-equiv="refresh" content="2;URL=importar_csv.php" />';