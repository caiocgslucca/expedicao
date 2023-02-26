<?php
include('verifica_login.php');
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
$destino = $_POST['destino'];
date_default_timezone_set('America/recife');
$datahora = (date('Y-m-d H:i:s'));

?>

<form action="finalizando.php" method="POST">
<div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Erro</h4>
                <button  id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <div class="alert alert-danger text-center " role="alert">
                        <h1> <b> Tem ceteza que deseja finalizar? </b> </h1>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <!-- <button submit class="btn btn-indigo">Voltar<i class="fas fa-paper-plane-o ml-1"></i></button> -->
                <div class="modal-footer justify-content-center">
                    <button type="submit" name="finalizar" class="btn btn-primary">Sim</button>
                </div>
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