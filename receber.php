<?php
// include('manutencao.html');
// exit();

include('verifica_login.php');
// session_start();
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
include('header_novo.php');
include('Header_CSS_JS.php');
// include('heder_estacao.php');
$usuario = $_SESSION['usuario'];
$destino = $_POST['destino'];


date_default_timezone_set('America/recife');
//date_default_timezone_set('America/Recife');

$datahora = (date('Y-m-d H:i:s'));
$datahorainicio = (date('Y-m-d 00:00:00'));
$datahorafinal = (date('Y-m-d 23:59:59'));


?>

<form method="POST" action="receber_pacote.php" enctype="multipart/form-data">
    <title>Receber-Pacote</title>

    <ul class="nav nav-tabs justify-content-center lighten-4 py-4">
        <li class="nav-item">
            <a class="nav-link active" href="receber">Receber Pacote</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="recebido">Hitórico Recebido</a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link " href="destino.php">Produtividade</a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link " href="gerenciar.php">Gerenciar</a>
        </li>  -->
        <!-- <li class="nav-item">
            <a class="nav-link " href="historico.php">Historico</a>
        </li> -->

    </ul>
    <br>
    <div class="container text-center" style="display: inline-block;">
  <div class="row">
    <div class="col-auto align-self-start">
    <table id="" class="table table-bordered table-sm" cellspacing="0" width="10%">
                    <thead>
                        <tr>

                            <th class="th-sm">Status</th>
                            <th class="th-sm text-center">Qtde.</th>
                            <th class="th-sm text-center">%</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $select_painel = ("SELECT
                        case WHEN recebido.pacote <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                        case WHEN recebido.pacote <> '' THEN COUNT(recebido.pacote) ELSE COUNT(producao.pacote) END 'Qtde.',
                        
                        case WHEN recebido.pacote <> '' THEN ROUND(COUNT(recebido.pacote) / (SELECT
                        COUNT(producao.pacote)
                        FROM `db` as producao 
                        WHERE producao.deleted_at IS NULL and producao.finalizado IS NULL) *100,2) ELSE ROUND(COUNT(producao.pacote) / (SELECT
                        COUNT(producao.pacote)
                        FROM `db` as producao 
                        WHERE producao.deleted_at IS NULL and producao.finalizado IS NULL) *100,2) END '%'
                        
                        FROM `db` as producao
                        LEFT OUTER JOIN `pcp_recebido` as recebido on recebido.pacote = producao.pacote and recebido.deleted_at IS NULL and recebido.finalizado IS NULL 
                        WHERE producao.deleted_at IS NULL and producao.finalizado IS NULL GROUP BY `Status` 
                        UNION
                        SELECT DISTINCT
                        'Total' as 'Status',
                        COUNT(pacote) as 'Qtde.',
                        '' as '%'
                        FROM `db` 
                        WHERE deleted_at IS NULL and finalizado IS NULL ORDER BY `Qtde.` ASC
                        
                        ");

                        // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                        $result_painel = mysqli_query($conexao, $select_painel);
                        
                        while ($row = mysqli_fetch_assoc($result_painel)) {

                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['Status'] ?>
                                </td>
                                <td class="th-sm text-center">
                                    <?php echo $row['Qtde.'] ?>
                                </td>
                                <td class="th-sm text-center">
                                    <?php echo $row['%'] ?>
                                </td>
                            </tr>
                            <?php } ; ?>

                    </tbody>
                </table>
                
    </div>
    <div class="col-auto align-self-center col-md-2 offset-md-4">
    <input required placeholder="Bipar Pacote" name="biper" value="" autofocus class="form-control z-depth-1"
                            id="exampleFormControlTextarea6" rows="3"></input>
    </div>
    <div class="col-auto align-self-center">
    <button type="submit" class="btn btn-success">Receber</button>
    </div>
  </div>
</div>

   
</form>



<div class="flex-center flex-column" style="display:block">
    <div class="card card-body">
        <?php

        $ok = 0;
        $recebidos2 = ("SELECT * FROM `pcp_recebido` where usuario = '$usuario' and deleted_at IS NULL and finalizado IS NULL");
        $recebidos3 = mysqli_query($conexao, $recebidos2);
        while ($row = mysqli_fetch_assoc($recebidos3)) {
            $ok++;
        }
        echo "Qtde. de registro: " . $ok;
        ?>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th class="th-sm">id</th>
                    <th class="th-sm">Pacote</th>
                    <th class="th-sm">Pedido</th>
                    <th class="th-sm">Nota Fiscal</th>
                    <th class="th-sm">Usuario</th>
                    <th class="th-sm">Data Hora</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $recebidos = ("SELECT * FROM `pcp_recebido` where usuario = '$usuario' and deleted_at IS NULL and finalizado IS NULL ORDER BY `pcp_recebido`.`id` DESC ");

                // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                $result = mysqli_query($conexao, $recebidos);
                $index = 1;
                while ($row = mysqli_fetch_assoc($result)) {

                    if ($row['Status'] == 'Faltando Receber') {
                        $status = "<b style='color:red;'>Faltando Receber</b>";
                    } else {
                        $status = "<b style='color:green;'> " . $status = $row['Status'] . "</b>";

                    }

                    ?>
                    <tr>
                        <td>
                            <?php echo $index ?>
                        </td>
                        <td>
                            <?php echo $row['pacote'] ?>
                        </td>
                        <td>
                            <?php echo $row['pedido'] ?>
                        </td>
                        <td>
                            <?php echo $row['nota_fiscal'] ?>
                        </td>
                        <td>
                            <?php echo $row['usuario'] ?>
                        </td>
                        <td>
                            <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?>
                        </td>
                    </tr>

                    <?php $index++;
                }
                ; ?>

            </tbody>
        </table>
    </div>
</div>

<br>
<?php

?>