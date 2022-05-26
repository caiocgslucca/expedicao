<?php
// session_start();
include('verifica_login.php');
ob_start();
include('conexao.php');
// include('header5.php');
date_default_timezone_set('America/recife');
$datahora = (date('d-m-Y_H:i:s'));
$usuario = $_SESSION['usuario'];
$id_status = 1;
$data = date("Y/m/d");

$arquivo = $datahora.'_'.'PCP_producao.xls';
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
                        
                        <th class="th-sm"><?php echo utf8_decode("IMEI"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Marca"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Modelo"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Produto"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Condição"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Destino"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Usuario"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("DATA HORA"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("DIA"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("MÊS"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("ANO"); ?></th>
            </tr>
        </thead>
        <tbody>

            <?php

            // where  DATE_FORMAT(data_hora, '%d/%m/%Y') = '$data'
            // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` IN ('1')  AND DATE_FORMAT(data_hora, '%d/%m/%Y') BETWEEN '$data' AND '$data' ORDER BY `testefull`.`data_hora` DESC");
            // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` = 1  AND `data_hora` BETWEEN '$data 00:00:00' AND '$data 23:59:59' ORDER BY `testefull`.`data_hora` DESC");
            $result_usuarios = ("SELECT * FROM `pcp_producao` WHERE  `data_hora` BETWEEN '$data 00:00:00' AND '$data 23:59:59' GROUP BY `pcp_producao`.`imei` ORDER BY `pcp_producao`.`data_hora` ASC");
            
            $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
            while ($row = mysqli_fetch_assoc($resultado_usuarios)) {

            ?>
                <tr>
                            <td> <?php echo utf8_decode("'".$row['imei']) ?> </td>
                            <td> <?php echo utf8_decode($row['marca']) ?> </td>
                            <td> <?php echo utf8_decode($row['modelo']) ?> </td>
                            <td> <?php echo utf8_decode($row['produto']) ?> </td>
                            <td> <?php echo utf8_decode($row['condicao']) ?> </td>
                            <td> <?php echo utf8_decode($row['destino']) ?> </td>
                            <td> <?php echo utf8_decode($row['usuario']) ?> </td>
                            <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>
                            <td> <?php echo date('d', strtotime($row['data_hora'])) ?> </td>
                            <td> <?php echo date('m', strtotime($row['data_hora'])) ?> </td>
                            <td> <?php echo date('Y', strtotime($row['data_hora'])) ?> </td>
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
                        <th class="th-sm"><?php echo utf8_decode("IMEI"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Marca"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Modelo"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Produto"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Condição"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Destino"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("Usuario"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("DATA HORA"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("DIA"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("MÊS"); ?></th>
                        <th class="th-sm"><?php echo utf8_decode("ANO"); ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        // where  DATE_FORMAT(data_hora, '%d/%m/%Y') = '$data'
                        // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` = 1 AND `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' ORDER BY `testefull`.`data_hora` DESC");
                        // $result_usuarios = ("SELECT * FROM `testefull` WHERE  `id_status` = 1  AND `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' ORDER BY `testefull`.`data_hora` DESC");
                        $result_usuarios = ("SELECT * FROM `pcp_producao` WHERE  `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' GROUP BY `pcp_producao`.`imei` ORDER BY `pcp_producao`.`data_hora` ASC");
                        
                        $resultado_usuarios = mysqli_query($conexao, $result_usuarios);
                        while ($row = mysqli_fetch_assoc($resultado_usuarios)) {

                        ?>
                            <tr>
                            <td> <?php echo utf8_decode("'".$row['imei']) ?> </td>
                            <td> <?php echo utf8_decode($row['marca']) ?> </td>
                            <td> <?php echo utf8_decode($row['modelo']) ?> </td>
                            <td> <?php echo utf8_decode($row['produto']) ?> </td>
                            <td> <?php echo utf8_decode($row['condicao']) ?> </td>
                            <td> <?php echo utf8_decode($row['destino']) ?> </td>
                            <td> <?php echo utf8_decode($row['usuario']) ?> </td>
                            <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>
                            <td> <?php echo date('d', strtotime($row['data_hora'])) ?> </td>
                            <td> <?php echo date('m', strtotime($row['data_hora'])) ?> </td>
                            <td> <?php echo date('Y', strtotime($row['data_hora'])) ?> </td>
                            </tr>

                        <?php }; ?>

                    </tbody>

</table>
<?php
}
?>