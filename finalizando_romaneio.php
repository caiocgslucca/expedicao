<?php
include('verifica_login.php');
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
$destino = $_POST['destino'];
date_default_timezone_set('America/recife');
$datahora = (date('Y-m-d H:i:s'));

$recebidos2 = ("SELECT case WHEN recebido.nro_etiqueta <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status'
FROM `expedicao` as producao LEFT OUTER JOIN `expedicao_recebido` as recebido on recebido.nro_etiqueta = producao.nro_etiqueta and recebido.finalizado IS NULL WHERE producao.finalizado IS NULL  
and producao.deleted_at IS NULL group by `Status`");

// $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
$recebidos3 = mysqli_query($conexao, $recebidos2);

while ($row = mysqli_fetch_assoc($recebidos3)) {

    if ($row['Status'] == 'Faltando Receber') {
        ?>
         <form action="recebido_romaneio.php" method="POST">
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
                                    <h1><b>A Pacotes</b></h1>
                                   <h1><p><b>Faltando Receber</b></p></h1> 
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button submit class="btn btn-indigo">Ver histórico<i class="fas fa-paper-plane-o ml-1"></i></button>
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
exit();       
    } else {

        $sql_finalizar_recebido = ("UPDATE `expedicao_recebido` SET `finalizado` = '$datahora' where finalizado is null ");
        $finalizar_recebido = mysqli_query($conexao, $sql_finalizar_recebido);
        
        $sql_finalizar_db = ("UPDATE `expedicao` SET `finalizado` = '$datahora' where finalizado is null ");
        $finalizar_recebidos = mysqli_query($conexao, $sql_finalizar_db);
        
        ?>

        <!-- <form action="gerenciar.php" method="POST"> -->

        <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Finalizado</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-3">
                        <div class="md-form mb-5">
                            <div class="alert alert-primary text-center " role="alert">
                                <h1> <b> Finalizado com sucesso: </b>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <!-- <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
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
echo '<meta http-equiv="refresh" content="3;URL=receber_romaneio.php" />';

    }
   
}

?>
         <form action="recebido_romaneio.php" method="POST">
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
                                    <h1><b>Processo já finalizado</b></h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <!-- <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
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
echo '<meta http-equiv="refresh" content="3;URL=receber_romaneio.php" />';
exit();



?>