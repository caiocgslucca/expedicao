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
$datahorainicio = (date('y-m-d 00:00:00'));
$datahorafinal = (date('y-m-d 23:59:59'));


?>

<form method="POST" action="receber_imei.php" enctype="multipart/form-data">


    <ul class="nav nav-tabs justify-content-center lighten-4 py-4">
        <li class="nav-item">
            <a class="nav-link " href="destino.php">Produtividade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="gerenciar.php">Gerenciar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="historico.php">Historico</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="receber.php">Receber</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="recebido.php">Hitorico Recebido</a>
        </li>

    </ul>
    <br>
   
    <div class="flex-center flex-column">
        <div class="col-2">
            <div class="form-group shadow-textarea">
                <label for="exampleFormControlTextarea6"><b>Biper IMEI</b></label>
                <textarea name="biper[]" value="" class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3"></textarea>
            </div>
        </div>
        <div class="col-2">
            <div class="md-form mt-0">
                <button type="submit" class="btn btn-success">Receber</button>
            </div>
        </div>
    </div>
</form>

<div class="flex-center flex-column">
    <div class="card card-body">
        <?php

        $ok = 0;
        $recebidos2 = (" SELECT 
        producao.*,
                
                case WHEN recebido.imei <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                case WHEN recebido.imei <> '' THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                case WHEN recebido.imei <> '' THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'

                
                FROM `pcp_producao` as producao
                LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.imei = producao.imei
                
                WHERE producao.destino = '01_Ag.peça'
                and producao.status = '1' 
                and producao.data_hora >= '$datahorainicio'
                ORDER by `Status` DESC
                
        
        ");

        $recebidos3 = mysqli_query($conexao, $recebidos2);

        while ($row = mysqli_fetch_assoc($recebidos3)) {
            $ok++;
        }
        echo "Qtde. de registro: " . $ok;
        ?>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>

                    <th class="th-sm">IMEI</th>
                    <th class="th-sm">Produto</th>
                    <th class="th-sm">Condição</th>
                    <th class="th-sm">Destino</th>
                    <th class="th-sm">Status</th>
                    <th class="th-sm">Usuario</th>
                    <th class="th-sm">Data Hora</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $recebidos2 = ("SELECT 
                producao.*,
                
                case WHEN recebido.imei <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                case WHEN recebido.imei <> '' THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                case WHEN recebido.imei <> '' THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'

                
                FROM `pcp_producao` as producao
                LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.imei = producao.imei
                
                WHERE producao.destino = '01_Ag.peça'
                and producao.status = '1'
                and producao.data_hora >= '$datahorainicio'

                 ORDER by `Status` DESC
                
                ");

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
                        <td> <?php echo $row['imei'] ?> </td>
                       
                        <td> <?php echo $row['produto'] ?> </td>
                        <td> <?php echo $row['condicao'] ?> </td>
                        <td> <?php echo $row['destino'] ?> </td>
                        <td> <?php echo $status ?> </td>
                        <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                        <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                    </tr>

                <?php }; ?>

            </tbody>
        </table>
    </div>
</div>

<br>
<?php

?>