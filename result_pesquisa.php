<?php
// include('manutencao.html');
// exit();

include('verifica_login.php');
// session_start();
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
// include('pesquisar.php');
// include('heder_estacao.php');
$usuario = $_SESSION['usuario'];

date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');

$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));


$qtd = 0;
$id_status = 1;

$pedido = $_GET['pedido'];

?>
<!doctype html>
<html lang=pt-BR>
<div style="padding-left:15px">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Resultado da Pesquisa</title>
    </head>
    <hr>

    <form action="result_pesquisa.php" method="GET">

                <div class="flex-center flex-column">
                    <div class="col-2">
                    </div>
                </div>
                <div class="flex-center flex-column">
                <div class="col-2">
                    <div class="form-group shadow-textarea text-center">
                        <input placeholder="Bipar Pacote" name="pedido" value="" autofocus class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></input>
                    </div>
                </div> 
            </div>
            
                <div style="display:flex; justify-content:center"> 
                            <button type="submit" class="btn btn-success">Buscar</button>
    </form>

</div>

</div>
<button data-toggle="modal" data-target="#deletar_pedido<?php echo $pedido ?>" type="submit" class="btn btn-danger">Excluir</button>

                                                    <form action="deletar_pedido.php" method="POST">
                                                                        <div class="modal fade" id="deletar_pedido<?php echo $pedido ?>" tabindex="-1" role="dialog"
                                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header ">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">Excluir Pedido</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Você tem certeza que deseja excluir o Pedido: <b>
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
                            <th class="th-sm">Produto</th>
                            <th class="th-sm">Nota Fiscal</th>
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
                            recebido.id as id_pacote,
                            case WHEN recebido.pacote <> ''  THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                            case WHEN recebido.pacote <> ''  THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                            case WHEN recebido.pacote <> ''  THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'
                            FROM `db` as producao
                            LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.pacote = producao.pacote and recebido.deleted_at IS NULL
                            WHERE producao.deleted_at IS NULL  and producao.pedido = '$pedido' 
                             ORDER by `id` DESC");

                            // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                            $recebidos3 = mysqli_query($conexao, $recebidos2);

                            while ($row = mysqli_fetch_assoc($recebidos3)) {

                                if ($row['Status'] == 'Faltando Receber') {
                                    $status = "<b style='color:red;'>Faltando Receber</b>";
                                } else {
                                    $status = "<b style='color:green;'> " . $status = $row['Status'] . "</b>";

                                }

                                ?>
                                        <tr>
                                            <input id= "id<?php echo $row['id'] ?>" type="hidden" value="<?php echo $row['id'] ?>" >

                                            <td> <?php echo $row['id'] ?> </td>
                                            <td> <?php echo $row['pacote'] ?> </td>
                                            <td> <?php echo $row['pedido'] ?> </td>
                                            <td> <?php echo $row['nome_cliente'] ?> </td>
                                            <td> <?php echo $row['descricao'] ?> </td>
                                            <td> <?php echo $row['nota_fiscal'] ?> </td>
                                            <td> <?php echo $status ?> </td>
                                            <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                                            <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                                            <td class="text-center">
                                                <?php if ($row['id_pacote'] == "") {
                                                } else {
                                                    ?>
                                                                <div style="display:flex; justify-content:center">

                                                                    <form action="etiqueta.php" method="POST" enctype="multipart/form-data">
                                                                        <button style='font-size:24px; border:none;'><i class='fas fa-print' aria-hidden="true"></i></button>
                                                                        <!-- <i class='fas fa-print' style='font-size:24px;color:black' aria-hidden="true"></i> -->
                                                                        <input name="pacote" type="hidden" value="<?php echo $row['pacote'] ?>" >
                                                        
                                                                    </form>
                                                                    <button style='font-size:24px;color:red; border:none;'>
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

                            <?php }
                            ; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        