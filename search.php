<?php
// error_reporting(E_ERROR | E_PARSE);
include('verifica_login.php');
// session_start();
include('header_novo.php');
include('Header_CSS_JS.php');
$usuario = $_SESSION['usuario'];
include('conexao.php');
$data = date("d/m/Y");
$datahoje = date("Y-m-d");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Histórico-Recebido</title>
</head>

<body>

    <!-- <ul class="nav nav-tabs justify-content-center lighten-4 py-3">
        <li class="nav-item">
            <a class="nav-link" href="receber.php">Receber</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="recebido.php">Hitorico Recebido</a>
         </li>
    </ul> -->

    <!-- <div class="row row-cols-1 row-cols-md-12"> -->
        <!-- Card -->
       
        <form action="" method="POST">
            <!-- Start your project here-->
            <!-- <div style=""> -->
                <!-- <div class="table-responsive"> -->
                <!-- <div class="flex-center flex-column flex-center" style="display: inline-flex;"> -->

                    <br>

                    <div class="container" style="text-align-last: center">
                        <div class=" row justify-content-md-center">

                            <div class="col-sm-3">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                <input required placeholder="Bipar Pedido" name="biper" value="" autofocus class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></input>
                                </div>
                            </div>
                           
                            <div class="col-sm-0">
                                <button type="submit" class="btn btn-default">Buscar</button>
                            </div>
                        </div>
                        </div>
                        </div>


       
        <?php
        if (empty($_POST['biper'])) {
            $vazio = "";
        ?>
        <?php
        } else {

            $biper = $_POST['biper'];
?>

    <div class="flex-center flex-column" style="display:block;">
        <div class="card card-body">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                            <th class="th-sm">id</th>
                            <th class="th-sm">Pacote</th>
                            <th class="th-sm">Pedido</th>
                            <th class="th-sm">Cliente</th>
                            <th class="th-sm">BOX</th>
                            <th class="th-sm">SKU</th>
                            <th class="th-sm">Produto</th>
                            <th class="th-sm">Nota Fiscal</th>
                            <th class="th-sm">Observacao</th>
                            <th class="th-sm">Status</th>
                            <th class="th-sm">Usuario</th>
                            <th class="th-sm">Data Hora Recebebido</th>
                            <th class="th-sm">Data Hora Finalizada</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // $recebidos2 = ("SELECT * FROM `pcp_recebido` WHERE `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datainicio 00:00:009' ORDER BY `pcp_recebido`.`data_hora` DESC");
                    $recebidos2 = ("SELECT 
                    producao.*,
                    producao.finalizado 'Data finalizada',
                    recebido.obs,
                    recebido.id as id_pacote,
                    case WHEN recebido.pacote <> ''  THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                    case WHEN recebido.pacote <> ''  THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                    case WHEN recebido.pacote <> ''  THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'
                    FROM `db` as producao
                    LEFT OUTER JOIN `pcp_recebido` as recebido on recebido.pacote = producao.pacote 
                    WHERE producao.pedido = '$biper'
                     ORDER by `id` DESC");
                    $recebidos3 = mysqli_query($conexao, $recebidos2);

                    while ($row = mysqli_fetch_assoc($recebidos3)) {
                        if ($row['Status'] == 'Faltando Receber') {
                            $status = "<b style='color:red;'>Faltando Receber</b>";
                        } else {
                            $status = "<b style='color:green;'> " . $status = $row['Status']. "</b>";
    
                        }

                    ?>
                        <tr>
                                    <td> <?php echo $row['id'] ?> </td>
                                    <td> <?php echo $row['pacote'] ?> </td>
                                    <td> <?php echo $row['pedido'] ?> </td>
                                    <td> <?php echo $row['nome_cliente'] ?> </td>
                                    <td> <?php echo $row['box'] ?> </td>
                                    <td> <?php echo $row['sku'] ?> </td>
                                    <td> <?php echo $row['descricao'] ?> </td>
                                    <td> <?php echo $row['nota_fiscal'] ?> </td>
                                    <td> <?php echo $row['obs'] ?> </td>
                                    <td> <?php echo $status ?> </td>
                                    <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data finalizada'])) ?> </td>
                                    
                                               
                        </tr>
                    <?php }; ?>

                </tbody>
            </table>
        </div>
    </div>


    <br>
    </div>
    </div>
<?php

        }
?>
</body>

</html>

<br>