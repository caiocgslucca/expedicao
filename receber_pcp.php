<?php
include('verifica_login.php');
// session_start();
error_reporting(E_ERROR | E_PARSE);
include('header_novo.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
include('conexao.php');
$data = date("d/m/Y");
date_default_timezone_set('America/recife');
$datahora = (date('Y-m-d H:i:s'));
$id_status = '1';
?>
<br>



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receber</title>
</head>


<form method="POST" action="" enctype="multipart/form-data">
    <div class="flex-center flex-column">
        <div class="col-2">
            <div class="md-form mt-0">
                <input autofocus="" value="" name="imei" autocomplete="off" required="" type="text" id="form1" class="form-control">
                <label for="form1"><b>imei</b> </label>
            </div>
        </div>

        <div class="col-1">
            <!-- Material input -->
            <div class="md-form mt-0">
                <button type="submit" class="btn btn-success">Receber</button>
            </div>
        </div>
    </div>
    </div>
</form>


<?php

    $imei = trim($_POST['imei']);

if ( $imei == "") {
       

    ?>
    <div class="flex-center flex-column">
        <div class="card card-body">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                      
                        <th class="th-sm">Imei</th>
                        <th class="th-sm">Status</th>
                        <th class="th-sm">Marca</th>
                        <th class="th-sm">Modelo</th>
                        <th class="th-sm">Produto</th>
                        <th class="th-sm">Condição</th>
                        <th class="th-sm">Usuário</th>
                        <th class="th-sm">Data Hora</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $recebidos2 = ("SELECT * FROM `recebido_pcp`  ORDER BY `recebido_pcp`.`data_hora` DESC");

                    $recebidos3 = mysqli_query($conexao, $recebidos2);

                    while ($row = mysqli_fetch_assoc($recebidos3)) {
                        $ok++;

                    ?>
                        <tr>
                            
                            <td> <?php echo $row['imei_declarado'] ?> </td>
                            <td> <?php echo $row['position'] ?> </td>
                            <td> <?php echo $row['Marca'] ?> </td>
                            <td> <?php echo $row['Modelo'] ?> </td>
                            <td> <?php echo $row['produto_declarado'] ?> </td>
                            <td> <?php echo $row['Condicao_Declarada'] ?> </td>                            
                            
                            <td> <?php echo $row['usuario'] ?> </td>
                            <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>


                        </tr>

                    <?php };

                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php

    exit();

} else {

    $sql = ("SELECT imei_declarado FROM `dymo2` where `imei_declarado` = '$imei' ");
    $return = mysqli_query($conexao, $sql);


    if (mysqli_fetch_assoc($return) == NULL) {

?>
        <form action="receber_pcp.php" method="POST">
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
                                    <h1> <b> Imei ( <?php echo $imei ?> ) não foi localizado no banco de dados </b>
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

        $sql = ("SELECT * FROM `dymo2` where `imei_declarado` = '$imei' ");
        $recebidos = mysqli_query($conexao, $sql);
        while ($row = mysqli_fetch_assoc($recebidos)) {
            // print_r($row);

            $position = $row['position'];
            $Marca = $row['Marca'];
            $Modelo = $row['Modelo'];
            $produto_declarado = $row['produto_declarado'];
            $Condicao_Declarada = $row['Condicao_Declarada'];

        }

         $inserir = ("INSERT INTO `recebido_pcp`(`id`, `position`, `Marca`, `Modelo`, `produto_declarado`, `Condicao_Declarada`,
        `imei_declarado`, `id_status`, `usuario`, `data_hora`) 
         VALUES (NUll,'$position','$Marca','$Modelo','$produto_declarado','$Condicao_Declarada','$imei','$id_status','$usuario','$datahora') ");

        $_salvar = mysqli_query($conexao, $inserir);
       
        if ($_salvar == 1) {

            ?>
            
                <form action="receber_pcp.php" method="POST">
            
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
                                            <h1> <b> Recebido com sucesso </b>
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
                    //  echo '<meta http-equiv="refresh" content="2;URL=receber_pcp.php" />';
        
                exit();
                }else{

                    ?>
    
        <form action="receber_pcp.php" method="POST">
    
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
                                    <h1> <b> Erro ao receber </b>
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

    }
}
