<?php
include('conexao.php');
include('verifica_login.php');
date_default_timezone_set('America/Recife');
include('Header_CSS_JS.php');
$datahora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['usuario'];
$status = 1;

$biper  =  $_POST['biper'];


foreach ($biper as $key => $biper) :
    $result = array_map('trim', explode("\n", $biper));

    $in = "('" . implode("','", array_filter($result)) . "')";

    $in2 =  implode(',', array_filter($result));
endforeach;

$result_usuarios = ("SELECT * FROM pcp_producao WHERE imei IN $in and `destino` = '01_Ag.peça' GROUP BY imei");

$recebidos = mysqli_query($conexao, $result_usuarios);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    $imei = $row_usuario['imei'];
    $marca = $row_usuario['marca'];
    $modelo = $row_usuario['modelo'];
    $produto = $row_usuario['produto'];
    $condicao = $row_usuario['condicao'];
    $destino = $row_usuario['destino'];

    $insert_sql = "INSERT INTO `pcp_recebido`(`id`, `imei`, `marca`, `modelo`, `produto`, 
     `condicao`, `destino`, `status`, `usuario`, `data_hora`) VALUES 
     (NULL, '$imei', '$marca', '$modelo','$produto','$condicao','$destino','1', '$usuario', '$datahora')";
    
    $salvar = mysqli_query($conexao, $insert_sql);

}

 $update = " UPDATE `pcp_producao` SET `status` = '2' WHERE imei IN $in ";
$update_salve = mysqli_query($conexao, $update);

if (@$salvar == 1) {
?>

    <form action="receber.php" method="POST">

    <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Recebido</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <div class="alert alert-primary text-center " role="alert">
                                <h1> <b> Recebido com sucesso </b></h1>
                            </div>
                        </div>
                        <div class="alert text-center " role="alert">
                            <?php
                            echo '<td><a button class="btn btn-outline-info" target="_blank" href="https://backoffice.trocafone.net/backoffice/pieces/piece-withdrawal-orders/fast-select/1/normal?codes=' . $in2 . '">Pronto aguardando peças</a></td>';
                            ?>
                            <?php
                            echo '<td><a button class="btn btn-outline-danger" target="_blank" href="https://backoffice.trocafone.net/backoffice/pieces/piece-withdrawal-orders/fast-select/1/defective?codes=' . $in2 . '">Pronto defeituoso a reparar</a></td>';
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        var senha = 0;

        if (senha != 1) {
            $('#modalSubscriptionForm').modal('show');
        }
    </script>
<?php
    echo '<meta http-equiv="refresh" content="4;URL=receber.php" />';
    exit();
} else {
?>

    <form action="receber.php" method="POST">

        <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <div class="alert alert-danger text-center " role="alert">
                                <h1> <b> Erro ao Receber </b></h1>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        var senha = 0;

        if (senha != 1) {
            $('#modalSubscriptionForm').modal('show');
        }
    </script>
<?php

}

?>