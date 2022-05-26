<?php
include('conexao.php');
include('verifica_login.php');
date_default_timezone_set('America/Recife');
include('Header_CSS_JS.php');
$datahora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['usuario'];
$status = 1;

$destino = trim($_POST['destino']);
$biper  =  $_POST['biper'];

$ok = 0;
$erro = 0;

foreach ($biper as $key => $biper) :
    $result = array_map('trim', explode("\n", $biper));

    $in = "('" . implode("','", array_filter($result)) . "')";

    $in2 =  implode(',', array_filter($result));

endforeach;

$result_2 = array_map('trim', explode("\n", $biper));

$result_usuarios = ("SELECT * FROM dymo2 WHERE imei_declarado IN $in GROUP BY imei_declarado");

$recebidos = mysqli_query($conexao, $result_usuarios);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    $imei = $row_usuario['imei_declarado'];
    $imei_2[] = $row_usuario['imei_declarado'];
    $marca = $row_usuario['Marca'];
    $modelo = $row_usuario['Modelo'];
    $produto = $row_usuario['produto_declarado'];
    $condicao = $row_usuario['Condicao_Declarada'];

    $insert_sql = "INSERT INTO `pcp_producao`(`id`, `imei`, `marca`, `modelo`, `produto`, 
    `condicao`, `destino`,`status`,`usuario`, `data_hora`) VALUES 
    (NULL, '$imei', '$marca', '$modelo','$produto','$condicao','$destino', '1', '$usuario', '$datahora')";

    $salvar = mysqli_query($conexao, $insert_sql);
}


@$ID_incluir = array_diff($result_2, $imei_2);

@$erro_incluir = implode("; ", $ID_incluir);


if (@$salvar == 1) {

?>

    <form action="destino.php" method="POST">

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

                        <?php
                        if ($erro_incluir == "") {
                        } else {
                        ?>
                            <div class="md-form mb-5">
                                <div class="alert alert-danger text-center " role="alert">
                                    <h1> <b> Erro: <p> <?php echo $erro_incluir ?> </p> </b></h1>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="md-form mb-5">
                            <div class="alert alert-primary text-center " role="alert">
                                <h1> <b> Inserido com sucesso </b></h1>
                            </div>
                        </div>
                        <div class="alert text-center " role="alert">
                            <?php
                            echo '<td><a button class="btn btn-outline-danger" target="_blank" href="https://backoffice.trocafone.net/backoffice/maintenance/pending-defective-evaluation/fast-select?imeis=' . $in2 . '">Pendente Avaliação Defeituoso</a></td>';
                            ?>
                            <?php
                            echo '<td><a button class="btn btn-outline-info" target="_blank" href="https://backoffice.trocafone.net/backoffice/maintenance/waiting-maintenance/fast-select?codes=' . $in2 . '">Pendente a Endereçar</a></td>';
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

    exit();
} else {
?>

    <form action="destino.php" method="POST">

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
                                <h1> <b> Erro ao salvar </b></h1>
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