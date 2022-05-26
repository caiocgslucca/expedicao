<?php
session_start();
include('verifica_login.php');
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
error_reporting(E_ERROR | E_PARSE);

?>
<form action="destino_select.php" method="POST">

    <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Destino</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <select class="browser-default custom-select" name="destino">
                            <option selected disabled>Selecionar o destino</option>
                            <?php
                           echo $sql = ("SELECT * FROM `pcp_destino` where `status` = 1 ");
                            $return = mysqli_query($conexao, $sql);
                            while ($row = mysqli_fetch_assoc($return)) {
                            ?> <option value=" <?php echo $row['destino'] ?> "><?php echo $row['destino'] ?></option> <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button submit class="btn btn-indigo">Selecionar<i class="fas fa-paper-plane-o ml-1"></i></button>
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