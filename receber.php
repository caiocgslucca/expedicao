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


?>

<form method="POST" action="receber_pacote.php" enctype="multipart/form-data">
<title>Receber-Pacote</title>

    <ul class="nav nav-tabs justify-content-center lighten-4 py-4">
        <li class="nav-item">
            <a class="nav-link active" href="receber.php">Receber Pacote</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="recebido.php">Hitórico Recebido</a>
        </li>
         <!-- <li class="nav-item">
            <a class="nav-link " href="destino.php">Produtividade</a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link " href="gerenciar.php">Gerenciar</a>
        </li>  -->
        <!-- <li class="nav-item">
            <a class="nav-link " href="historico.php">Historico</a>
        </li> -->

    </ul>
    <br>
   
    <div class="flex-center flex-column">
        <div class="col-2">
            <div class="form-group shadow-textarea text-center">
                <!-- <label for="exampleFormControlTextarea6"><b>Pacote</b></label> -->
                <input placeholder="Bipar Pacote" name="biper" value="" autofocus class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></input>
            </div>
        </div>
        <div class="col-2 text-center">
            <div class="md-form mt-0">
                <button type="submit" class="btn btn-success">Receber</button>
            </div>
        </div>
    </div>
</form>

<div class="flex-center flex-column" style="display:block" >
    <div class="card card-body">
        <?php

        $ok = 0;
        $recebidos2 = ("SELECT * FROM `pcp_recebido` where usuario = '$usuario' and deleted_at IS NULL ");
        $recebidos3 = mysqli_query($conexao, $recebidos2);
        while ($row = mysqli_fetch_assoc($recebidos3)) {
            $ok++;
        }
        echo "Qtde. de registro: " . $ok;
        ?>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th class="th-sm">id</th>
                    <th class="th-sm">Pacote</th>
                    <th class="th-sm">Pedido</th>
                    <th class="th-sm">Nota Fiscal</th>
                    <th class="th-sm">Usuario</th>
                    <th class="th-sm">Data Hora</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $recebidos = ("SELECT * FROM `pcp_recebido` where usuario = '$usuario' and deleted_at IS NULL ORDER BY `pcp_recebido`.`id` DESC ");

                // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                $result = mysqli_query($conexao, $recebidos);
                $index = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                   
                    if ($row['Status'] == 'Faltando Receber') {
                        $status = "<b style='color:red;'>Faltando Receber</b>";
                    } else {
                        $status = "<b style='color:green;'> " . $status = $row['Status']. "</b>";

                    }

                ?>
                    <tr>
                        <td> <?php echo $index ?> </td>
                        <td> <?php echo $row['pacote'] ?> </td>
                        <td> <?php echo $row['pedido'] ?> </td>
                        <td> <?php echo $row['nota_fiscal'] ?> </td>
                        <td> <?php echo $row['usuario'] ?> </td>
                        <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>
                    </tr>

                <?php $index ++; }; ?>

            </tbody>
        </table>
    </div>
</div>

<br>
<?php

?>