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

                <ul class="nav nav-tabs justify-content-center py-4">
                    <li class="nav-item">
                        <a class="nav-link" href="receber.php">Receber Pacote</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="recebido.php">Hitórico Recebido</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="finalizar.php">Finalizar Processo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pedido.php">Excluir Pedido</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historico_finalizado.php">Histórico Finalizado</a>
                    </li>
                </ul>

                    <div class="container" style="text-align-last: center">
                        <div class=" row justify-content-md-center">

                            <div class="col-sm-3">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input name="dateinicio" type="date" class="form-control">
                                    <label for="inicio">Selecionar data Inicio</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="md-form md-outline input-with-post-icon datepicker">
                                    <input name="datefinal" type="date" class="form-control">
                                    <label for="final">Selecionar data Final</label>
                                </div>
                            </div>
                            <div class="col-sm-0">
                                <button type="submit" class="btn btn-default btn-lg">Buscar</button>
                            </div>
                        </div>
       
        <?php
        if (empty($_POST['dateinicio'])) {
            $vazio = "";
        ?>
            <?php
            echo '<td><a button class="btn btn-success" href="export_recebido.php?dateini=' . "" . '">Clique aqui para fazer o download <p> Referente à Data: ' . $data . '</p> </a></td>';
            echo "<br>";
            ?>
                    </div>

             </form>

             <button data-toggle="modal" data-target="#receber_total<?php echo $pedido ?>" type="submit" class="btn btn-info">Receber Total</button>
<form action="receber_total.php" method="POST">
    <div class="modal fade" id="receber_total<?php echo $pedido ?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="exampleModalLabel">RECEBER TOTAL</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja Receber todos os Pacote: <b>
                        <?php echo $pedido ?> </b> ?
                </div>
                <input name="pedido" type="hidden" id="inputName"
                    value="<?php echo $pedido ?>" class="form-control validate">
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Sim</button>
                </div>
            </div>
        </div>
    </div>
</form>

            <div class="flex-center flex-column" style="display:block;">
                <div class="card card-body">
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th class="th-sm">id</th>
                            <th class="th-sm">Pacote</th>
                            <th class="th-sm">Pedido</th>
                            <th class="th-sm">Cliente</th>
                            <th class="th-sm">SKU</th>
                            <th class="th-sm">Produto</th>
                            <th class="th-sm">Nota Fiscal</th>
                            <th class="th-sm">Observação</th>
                            <th class="th-sm">Status</th>
                            <th class="th-sm">Usuario</th>
                            <th class="th-sm">Data Hora</th>
                            <th class="th-sm text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // $recebidos2 = ("SELECT * FROM `pcp_recebido` WHERE  `data_hora` BETWEEN '$datahoje 00:00:00' AND '$datahoje 23:59:59' ORDER BY `pcp_recebido`.`data_hora` DESC");
                            $recebidos2 = ("SELECT 
                            producao.*,
                            recebido.obs,
                            recebido.id as id_pacote,
                            case WHEN recebido.pacote <> ''  THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                            case WHEN recebido.pacote <> ''  THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                            case WHEN recebido.pacote <> ''  THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'
                            FROM `db` as producao
                            LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.pacote = producao.pacote and recebido.deleted_at IS NULL and recebido.finalizado IS NULL
                            WHERE producao.deleted_at IS NULL and producao.finalizado IS NULL
                             ORDER by `id` DESC");

                            // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                            $recebidos3 = mysqli_query($conexao, $recebidos2);

                            while ($row = mysqli_fetch_assoc($recebidos3)) {

                                if ($row['Status'] == 'Faltando Receber') {
                                    $status = "<b style='color:red;'>Faltando Receber</b>";
                                } else {
                                    $status = "<b style='color:green;'> " . $status = $row['Status']. "</b>";
            
                                }

                            ?>
                                <tr>
                                    <input id= "id<?php echo $row['id'] ?>" type="hidden" value="<?php echo $row['id'] ?>" >

                                    <td> <?php echo $row['id'] ?> </td>
                                    <td> <?php echo $row['pacote'] ?> </td>
                                    <td> <?php echo $row['pedido'] ?> </td>
                                    <td> <?php echo $row['nome_cliente'] ?> </td>
                                    <td> <?php echo $row['sku'] ?> </td>
                                    <td> <?php echo $row['descricao'] ?> </td>
                                    <td> <?php echo $row['nota_fiscal'] ?> </td>
                                    <td> <?php echo $row['obs'] ?> </td>
                                    <td> <?php echo $status ?> </td>
                                    <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                                    <td class="text-center">
                                        <div style="display:flex; justify-content:center">

                                        <?php if( $row['id_pacote'] == "" ){
                                                ?>
                                                        <button style='font-size:24px; border:none; color: limegreen; background-color: transparent;'><i  data-toggle="modal" data-target="#receber<?php echo $row['id'] ?>" class='fas fa-arrow-right' aria-hidden="true"></i></button>
                                                        
                                                        <form action="receber_pacote.php" method="POST" enctype="multipart/form-data">
                                                                    <input name="biper" type="hidden" value="<?php echo $row['pacote'] ?>" >
                                                                <div class="modal fade" id="receber<?php echo $row['id'] ?>" tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header ">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Receber Pacote</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Receber o Pacote: <b>
                                                                                            <?php echo $row['pacote'] ?> </b> ?
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                             <div class="form-group shadow-textarea">
                                                                                                <label for="exampleFormControlTextarea6"><b>Observação</b></label>
                                                                                                <textarea style="text-transform: uppercase;" autofocus name="observacao" value="" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></textarea>
                                                                                                 </div> 
                                                                                    </div>

                                                                                    <input name="id_pacote" type="hidden" id="inputName"
                                                                                        value="<?php echo $row['id_pacote'] ?>" class="form-control validate">

                                                                                    <div class="modal-footer justify-content-center">
                                                                                        <button type="submit" class="btn btn-primary">Sim</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </form>
                                                                        <?php
                                            }else{
                                                ?>

                                                    <form action="reimpressao_etiqueta.php" method="POST" enctype="multipart/form-data">
                                                        <button style='font-size:24px; border:none; background-color: transparent;'><i class='fas fa-print' aria-hidden="true"></i></button>
                                                        <!-- <i class='fas fa-print' style='font-size:24px;color:black' aria-hidden="true"></i> -->
                                                        <input name="pacote" type="hidden" value="<?php echo $row['pacote'] ?>" >
                                                        
                                                    </form>
                                                    <?php 
                                                       if( $row['qtd_itens'] > 1 ){
                                                           ?>
                                                          <form action="reimpressao_etiqueta_todas.php" method="POST" enctype="multipart/form-data">
                                                              <button style='font-size:24px; color:blue; border:none; background-color: transparent;'><i class='fas fa-cloud-download-alt' aria-hidden="true"></i></button>
                                                              <!-- <i class='fas fa-print' style='font-size:24px;color:black' aria-hidden="true"></i> -->
                                                              <input name="pedido" type="hidden" value="<?php echo $row['pedido'] ?>" >
                                                            </form>
                                                         <?php   
                                                            }
                                                        ?>
                                                    <button style='font-size:24px;color:red; border:none; background-color: transparent;'>
                                                        <i id="excluir_item<?php echo $row['id'] ?>" data-toggle="modal" data-target="#deletar<?php echo $row['id'] ?>" class='fas fa-trash-alt'  aria-hidden="true"></i>
                                                    </button>
                                                </div>

                                                <form action="deletar_item.php" method="POST">
                                                                        <div class="modal fade" id="deletar<?php echo $row['id'] ?>" tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header ">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Pacote</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Você tem certeza que deseja excluir o Pacote: <b>
                                                                                            <?php echo $row['pacote'] ?> </b> ?
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                            Referente ao Pedido: <b>
                                                                                            <?php echo $row['pedido'] ?> </b> ?
                                                                                    </div>

                                                                                    <input name="id_pacote" type="hidden" id="inputName"
                                                                                        value="<?php echo $row['id_pacote'] ?>" class="form-control validate">

                                                                                    <div class="modal-footer justify-content-center">
                                                                                        <button type="submit" class="btn btn-primary">Sim</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                    </form>
                                                <?php
                                            }
                                            ?>
                                    </td>
                                                        
                                </tr>

                            <?php }; ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <br>
    <!-- </div> -->
    <!-- </div> -->
<?php
        } else {

            $Datainicio = date('Y-m-d', strtotime($_POST['dateinicio']));
            $Datafinal = date('Y-m-d', strtotime($_POST['datefinal']));

            echo '</div></div> <div class="container" style="text-align-last: center"> <td><a button class="btn btn-success" href="export_recebido.php?dateini=' . $Datainicio . ' 00:00:00' . '&datefinal=' . $Datafinal . ' 23:59:59' . '">Clique aqui para fazer o download  <p> Referente à Data: ' . date('d/m/Y', strtotime($Datainicio)) . " | " . date('d/m/Y', strtotime($Datafinal)) . '  </p>  </a></td> </div>';
            echo "<br>";
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
                            <th class="th-sm">SKU</th>
                            <th class="th-sm">Produto</th>
                            <th class="th-sm">Nota Fiscal</th>
                            <th class="th-sm">Observação</th>
                            <th class="th-sm">Status</th>
                            <th class="th-sm">Usuario</th>
                            <th class="th-sm">Data Hora</th>
                            <th class="th-sm text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // $recebidos2 = ("SELECT * FROM `pcp_recebido` WHERE `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datainicio 00:00:009' ORDER BY `pcp_recebido`.`data_hora` DESC");
                    $recebidos2 = ("SELECT 
                    producao.*,
                    recebido.obs,
                    recebido.id as id_pacote,
                    case WHEN recebido.pacote <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                    case WHEN recebido.pacote <> '' THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                    case WHEN recebido.pacote <> '' THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'
                    FROM `db` as producao
                    LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.pacote = producao.pacote and recebido.deleted_at IS NULL and recebido.finalizado IS NULL
                    WHERE producao.`data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' and producao.deleted_at IS NULL and producao.finalizado IS NULL
                     ORDER by `id` DESC");

                    // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorainicio' ORDER BY `data_hora` DESC");                   
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
                                    <td> <?php echo $row['sku'] ?> </td>
                                    <td> <?php echo $row['descricao'] ?> </td>
                                    <td> <?php echo $row['nota_fiscal'] ?> </td>
                                    <td> <?php echo $row['obs'] ?> </td>
                                    <td> <?php echo $status ?> </td>
                                    <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                                    <td class="text-center">
                                        <?php if( $row['id_pacote'] == "" ){
                                            ?>
                                              <button style='font-size:24px; border:none; color: limegreen; background-color: transparent;'><i  data-toggle="modal" data-target="#receber<?php echo $row['id'] ?>" class='fas fa-arrow-right' aria-hidden="true"></i></button>
                                                        
                                              <form action="receber_pacote.php" method="POST" enctype="multipart/form-data">
                                                          <input name="biper" type="hidden" value="<?php echo $row['pacote'] ?>" >
                                                      <div class="modal fade" id="receber<?php echo $row['id'] ?>" tabindex="-1" role="dialog"
                                                                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog" role="document">
                                                                      <div class="modal-content">
                                                                          <div class="modal-header ">
                                                                              <h5 class="modal-title" id="exampleModalLabel">Receber Pacote</h5>
                                                                              <button type="button" class="close" data-dismiss="modal"
                                                                                  aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                              Receber o Pacote: <b>
                                                                                  <?php echo $row['pacote'] ?> </b> ?
                                                                          </div>
                                                                          <div class="modal-body">
                                                                                   <div class="form-group shadow-textarea">
                                                                                      <label for="exampleFormControlTextarea6"><b>Observação</b></label>
                                                                                      <textarea style="text-transform: uppercase;" autofocus name="observacao" value="" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></textarea>
                                                                                       </div> 
                                                                          </div>

                                                                          <input name="id_pacote" type="hidden" id="inputName"
                                                                              value="<?php echo $row['id_pacote'] ?>" class="form-control validate">

                                                                          <div class="modal-footer justify-content-center">
                                                                              <button type="submit" class="btn btn-primary">Sim</button>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                      </form>
                                                              <?php
                                            }else{
                                                ?>
                                                
                                                <i id="excluir_item<?php echo $row['id'] ?>" data-toggle="modal" data-target="#deletar<?php echo $row['id'] ?>" class='fas fa-trash-alt' style='font-size:24px;color:red'></i>
                                                <form action="deletar_item.php" method="POST">
                                                                        <div class="modal fade" id="deletar<?php echo $row['id'] ?>" tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header ">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Pacote</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Você tem certeza que deseja excluir o Pacote: <b>
                                                                                            <?php echo $row['pacote'] ?> </b> ?
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                            Referente ao Pedido: <b>
                                                                                            <?php echo $row['pedido'] ?> </b> ?
                                                                                    </div>

                                                                                    <input name="id_pacote" type="hidden" id="inputName"
                                                                                        value="<?php echo $row['id_pacote'] ?>" class="form-control validate">

                                                                                    <div class="modal-footer justify-content-center">
                                                                                        <button type="submit" class="btn btn-primary">Sim</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                    </form>
                                                <?php
                                            }
                                            ?>
                                         

                                    </td>
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