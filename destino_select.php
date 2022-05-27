<?php
include('verifica_login.php');
// include('manutencao.html');
// exit();
// session_start();
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
// include('heder_estacao.php');
$usuario = $_SESSION['usuario'];
// $destino = $_POST['destino'];
$destino = $_SESSION['destino'];

date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');

$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));


if ($destino == "" || $destino == "Selecionar a estação") {
    // echo "<script> alert (' ( $usuario ) Estação não selecionada'); </script>";

?>
<title>Destino</title>
<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Erro</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <legend><b> Destino não selecionado </b></legend>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <!-- <button submit class="btn btn-indigo">Selecionar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
                <?php echo '<td><a button class="btn btn-danger" href="destino.php">Fechar</a></td>' ?>
            </div>
        </div>
    </div>
</div>
<script>
var senha = 0;

if (senha != 1) {
    $('#modalSubscriptionForm').modal('show');
}
</script>
<?php
    exit();
} else {
}

?>
<form>
    <?php echo '<a button class="btn btn-info" href="destino.php">Trocar Destino</a>'; ?>
</form>

<form method="POST" action="salvar.php" enctype="multipart/form-data">
    <!-- <ul class="nav nav-tabs justify-content-center lighten-4 py-4">
        <li class="nav-item">
            <a class="nav-link active" href="destino.php">Produtividade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="gerenciar.php">Gerenciar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="historico.php">Historico</a>
        </li>

    </ul> -->
    <br>
    <div class="flex-center flex-column">
        <!-- Grid column -->
        <div class="col-2">
            <!-- Material input -->
            <div class="md-form mt-0">
                <input disabled autocomplete="off" type="text" class="form-control" value="<?php echo $destino ?>">
                <input name="destino" autocomplete="off" type="hidden" class="form-control"
                    value="<?php echo $destino ?>">
                <label for="extacao"><b>Destino selecionado:</b> </label>
            </div>
        </div>
    </div>


    <div class="flex-center flex-column">
        <div class="col-2">
            <!-- <div class="form-group shadow-textarea"> -->
            <!-- <label for="exampleFormControlTextarea6"><b>Biper IMEI</b></label> -->
            <!-- <textarea name="biper[]" value="" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></textarea> -->
            <!-- </div> -->
            <div class="form-outline">
                <input name="biper" autofocus type="text" id="form12" class="form-control" />
                <label class="form-label " for="form12">Bipar</label>
            </div>
        </div>
        <div class="col-2">
            <div class="md-form mt-0">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
</form>

<div class="flex-center flex-column">
    <div class="card card-body" style='display: block;'>
        <?php

        $ok = 0;
        $recebidos2 = ("SELECT * FROM `pcp_producao` WHERE  `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `pcp_producao`.`data_hora` DESC");

        $recebidos3 = mysqli_query($conexao, $recebidos2);

        while ($row = mysqli_fetch_assoc($recebidos3)) {
            $ok++;
        }
        echo "Qtde. de registro: " . $ok;
        ?>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th class="th-sm">IMEI</th>
                    <!-- <th class="th-sm">Marca</th> -->
                    <!-- <th class="th-sm">Modelo</th> -->
                    <!-- <th class="th-sm">Produto</th> -->
                    <!-- <th class="th-sm">Condição</th> -->
                    <th class="th-sm">Destino</th>
                    <th class="th-sm">Usuario</th>
                    <th class="th-sm">Data Hora</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $recebidos2 = ("SELECT * FROM `pcp_producao` WHERE  `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `pcp_producao`.`data_hora` DESC");

                // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                $recebidos3 = mysqli_query($conexao, $recebidos2);

                while ($row = mysqli_fetch_assoc($recebidos3)) {
                    $ok++;

                ?>
                <tr>
                    <td> <?php echo $row['imei'] ?> </td>
                    <!-- <td> <?php echo $row['marca'] ?> </td> -->
                    <!-- <td> <?php echo $row['modelo'] ?> </td> -->
                    <!-- <td> <?php echo $row['produto'] ?> </td> -->
                    <!-- <td> <?php echo $row['condicao'] ?> </td> -->
                    <td> <?php echo $row['destino'] ?> </td>
                    <td> <?php echo $row['usuario'] ?> </td>
                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>
                </tr>

                <?php }; ?>

            </tbody>
        </table>
    </div>
</div>

<br>
<?php

?>