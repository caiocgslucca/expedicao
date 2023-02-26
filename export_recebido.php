<?php
session_start();
include('verifica_login.php');
ob_start();
include('conexao.php');
// include('header5.php');
date_default_timezone_set('America/recife');
$datahora = (date('d-m-Y_H:i:s'));
$usuario = $_SESSION['usuario'];
$id_status = 1;
$data = date("Y/m/d");

$arquivo = $datahora.'_'.'recebido.xls';
header ("Content-Type: application/xls");
header ("Content-Disposition: attachment; filename= {$arquivo}" );

?>
<style>
table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
}
</style>

<?php

if (empty($_GET['dateini'])) {
    $Datainicio = "";
?>
    <table>
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
            </tr>
        </thead>
        <tbody>

            <?php

            // where  DATE_FORMAT(data_hora, '%d/%m/%Y') = '$data'
            // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` IN ('1')  AND DATE_FORMAT(data_hora, '%d/%m/%Y') BETWEEN '$data' AND '$data' ORDER BY `testefull`.`data_hora` DESC");
            // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` = 1  AND `data_hora` BETWEEN '$data 00:00:00' AND '$data 23:59:59' ORDER BY `testefull`.`data_hora` DESC");
            // $result_usuarios = ("SELECT * FROM `pcp_recebido` WHERE  `data_hora` BETWEEN '$data 00:00:00' AND '$data 23:59:59' ORDER BY `pcp_recebido`.`data_hora` DESC");
            $result_usuarios = ("SELECT 
            producao.*,
            case WHEN recebido.pacote <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
            case WHEN recebido.pacote <> '' THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
            case WHEN recebido.pacote <> '' THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'
            FROM `db` as producao
            LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.pacote = producao.pacote
            WHERE producao.`data_hora` BETWEEN '$data 00:00:00' AND '$data 23:59:59' and producao.deleted_at IS NULL
             ORDER by `id` ASC");
            
            $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
            while ($row = mysqli_fetch_assoc($resultado_usuarios)) {
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
                                    <td> <?php echo $row['descricao'] ?> </td>
                                    <td> <?php echo $row['nota_fiscal'] ?> </td>
                                    <td> <?php echo $status ?> </td>
                                    <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                            </tr>

            <?php }; ?>

        </tbody>
    </table>
<?php

} else {

    // $Datainicio = date('d/m/Y', strtotime($_GET['dateini']));
    // $Datafinal = date('d/m/Y', strtotime($_GET['datefinal']));

    $Datainicio = $_GET['dateini'];
    $Datafinal = $_GET['datefinal'];
    
?>
<table >

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
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // where  DATE_FORMAT(data_hora, '%d/%m/%Y') = '$data'
                        // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` = 1 AND `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' ORDER BY `testefull`.`data_hora` DESC");
                        // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` = 1  AND `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' ORDER BY `testefull`.`data_hora` DESC");
                        // $result_usuarios = ("SELECT * FROM `pcp_recebido` WHERE  `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' ORDER BY `pcp_recebido`.`data_hora` DESC");
                        $result_usuarios = ("SELECT 
                        producao.*,
                        case WHEN recebido.pacote <> '' THEN 'Recebido' ELSE 'Faltando Receber' END 'Status',
                        case WHEN recebido.pacote <> '' THEN recebido.data_hora ELSE producao.data_hora END 'Data Hora Atualizada',
                        case WHEN recebido.pacote <> '' THEN recebido.usuario ELSE producao.usuario END 'Usuario Atualizado'
                        FROM `db` as producao
                        LEFT OUTER JOIN `pcp_recebido` as recebido  on recebido.pacote = producao.pacote
                        WHERE producao.`data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' and producao.deleted_at IS NULL
                         ORDER by `id` ASC");
                        
                        $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
                        while ($row = mysqli_fetch_assoc($resultado_usuarios)) {

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
                                    <td> <?php echo $row['descricao'] ?> </td>
                                    <td> <?php echo $row['nota_fiscal'] ?> </td>
                                    <td> <?php echo $status ?> </td>
                                    <td> <?php echo $row['Usuario Atualizado'] ?> </td>
                                    <td> <?php echo date('d/m/Y H:i:s', strtotime($row['Data Hora Atualizada'])) ?> </td>
                            </tr>

                        <?php }; ?>

                    </tbody>

</table>
<?php
}
?>