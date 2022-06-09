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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Histórico Produção</title>
</head>

<body>

    <ul class="nav nav-tabs justify-content-center lighten-4 py-4">
        <li class="nav-item">
            <a class="nav-link " href="destino.php">Produtividade</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="gerenciar.php">Gerenciar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active " href="historico.php">Historico</a>
        </li>

    </ul>

    <div class="row row-cols-1 row-cols-md-12">
        <!-- Card -->
        <form action="" method="POST">
            <!-- Start your project here-->
            <div style="height: 100">
                <!-- <div class="table-responsive"> -->

                <div class="flex-center flex-column">
                    <div class="container">
                        <div class=" row justify-content-md-center">


                            <!-- <h1> JOÂO CLICK NO BOTÃO BUSCAR PARA SELECIONAR O PERIODO  </h1> -->

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
                            <div class="col-sm-3 center">
                                <button type="submit" class="btn btn-default btn-lg">Buscar</button>
                            </div>
                        </div>
                    </div>


        </form>
        <?php
        if (empty($_POST['dateinicio'])) {
            $vazio = "";
        ?>
        <?php
            echo '<td><a button class="btn btn-success" href="export.php?dateini=' . "" . '">Clique aqui para fazer o download <p> Referente à Data: ' . $data . '</p> </a></td>';
            echo "<br>";
            ?>
        <div class="flex-center flex-column">
            <div class="card card-body">
                <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">CODIGO</th>
                            <!-- <th class="th-sm">Marca</th>
                    <th class="th-sm">Modelo</th>
                    <th class="th-sm">Produto</th>
                    <th class="th-sm">Condição</th> -->
                            <th class="th-sm">Destino</th>
                            <th class="th-sm">Usuario</th>
                            <th class="th-sm">Data Hora</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $recebidos2 = ("SELECT * FROM `pcp_producao` WHERE  `data_hora` BETWEEN '$datahoje 00:00:00' AND '$datahoje 23:59:59' ORDER BY `pcp_producao`.`data_hora` DESC");

                            // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                            $recebidos3 = mysqli_query($conexao, $recebidos2);

                            while ($row = mysqli_fetch_assoc($recebidos3)) {
                               

                            ?>
                        <tr>
                            <td> <?php echo $row['imei'] ?> </td>
                            <!-- <td> <?php echo $row['marca'] ?> </td>
                        <td> <?php echo $row['modelo'] ?> </td>
                        <td> <?php echo $row['produto'] ?> </td>
                        <td> <?php echo $row['condicao'] ?> </td> -->
                            <td> <?php echo $row['destino'] ?> </td>
                            <td> <?php echo $row['usuario'] ?> </td>
                            <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>
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
        } else {

            $Datainicio = date('Y-m-d', strtotime($_POST['dateinicio']));
            $Datafinal = date('Y-m-d', strtotime($_POST['datefinal']));

            echo '<td><a button class="btn btn-success" href="export.php?dateini=' . $Datainicio . ' 00:00:00' . '&datefinal=' . $Datafinal . ' 23:59:59' . '">Clique aqui para fazer o download  <p> Referente à Data: ' . date('d/m/Y', strtotime($Datainicio)) . " | " . date('d/m/Y', strtotime($Datafinal)) . '  </p>  </a></td>';
            echo "<br>";
?>

    <div class="flex-center flex-column">
        <div class="card card-body">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">IMEI</th>
                        <!-- <th class="th-sm">Marca</th>
                    <th class="th-sm">Modelo</th>
                    <th class="th-sm">Produto</th>
                    <th class="th-sm">Condição</th> -->
                        <th class="th-sm">Destino</th>
                        <th class="th-sm">Usuario</th>
                        <th class="th-sm">Data Hora</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $recebidos2 = ("SELECT * FROM `pcp_producao` WHERE `data_hora` BETWEEN '$Datainicio 00:00:00' AND '$Datafinal 23:59:59' ORDER BY `pcp_producao`.`data_hora` DESC");

                    // $recebidos2 =("SELECT * FROM `testefull` WHERE `usuario` = '$usuario' AND `data_hora` BETWEEN '$datahorainicio' AND '$datahorafinal' ORDER BY `data_hora` DESC");                   
                    $recebidos3 = mysqli_query($conexao, $recebidos2);

                    while ($row = mysqli_fetch_assoc($recebidos3)) {
                       

                    ?>
                    <tr>
                        <td> <?php echo $row['imei'] ?> </td>
                        <!-- <td> <?php echo $row['marca'] ?> </td>
                        <td> <?php echo $row['modelo'] ?> </td>
                        <td> <?php echo $row['produto'] ?> </td>
                        <td> <?php echo $row['condicao'] ?> </td> -->
                        <td> <?php echo $row['destino'] ?> </td>
                        <td> <?php echo $row['usuario'] ?> </td>
                        <td> <?php echo date('d/m/Y H:i:s', strtotime($row['data_hora'])) ?> </td>
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