<?php
session_start();
include('Header_CSS_JS.php');
date_default_timezone_set('America/recife');
$datahora = (date('Y-m-d H:i:s'));
include('conexao.php');
$usuario = $_SESSION['usuario'];

 $estacao = $_POST['pecadetalhe'];

//  print_r($estacao);
//  echo "<br>";

foreach( $estacao as $result ){
    $id = $result['id'];
    $status = $result['status'];
    
    if ($status == '')
    continue;

 $salvar = "UPDATE `pcp_destino` SET `status` = '$status', `usuario` = '$usuario', `data_hora` = '$datahora'  WHERE `pcp_destino`.`id` = '$id';";
$_salvar = mysqli_query($conexao, $salvar);

}

 if ($_salvar == 1) {
    ?>
    
        <form action="gerenciar.php" method="POST">
    
            <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">Salvo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <div class="alert alert-primary text-center " role="alert">
                                    <h1> <b> Alteração feita com sucesso </b>
                                    </h1>
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
        exit();
    } else {
    ?>
    
        <form action="gerenciar.php" method="POST">
    
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
                                    <h1> <b> Erro na alteração </b>
                                    </h1>
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