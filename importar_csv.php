<?php
include('verifica_login.php');
// session_start();
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
    <title>Importar CSV</title>
</head>

<?php

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");
        $ok = 0;
        $erro = 0;
        while (($column = fgetcsv($file, 10000, ";")) !== FALSE) {

            if ($column[0] == '﻿PEDIDO' ||  $column[2] == '' || $column[0] == 'PEDIDO' )
                continue;

                // print_r($column);
                // echo "<br><br>";
                // exit();

            $sqlInsert = "INSERT INTO `db`(`id`, `pedido`, `nome_cliente`, `nota_fiscal`, `box`, `data_entrega`, 
            `carga`, `situacao`, `qtd_itens`, `sku`, `descricao`, `pacote`, `regiao`, `pacote_2`, `qtde`, `inv`, `usuario`, `data_hora`) VALUES
            (NULL, '$column[0]', '$column[1]', '$column[2]', '$column[3]', '$column[4]', '$column[5]', '$column[6]', '$column[7]', '$column[8]', '$column[9]',
            '$column[10]', '$column[11]', '$column[12]', '$column[13]', '$column[14]', '$usuario', '$datahora')";


            $result = mysqli_query($conexao, $sqlInsert);
            // echo "<br>";
            // echo $sqlInsert;
            // echo "<br>";

            if ($result == 1) {
                $ok = $ok + 1;
                $type1 = "success";
                $message1 = "Importado com sucesso: " . $ok;
            } else {
                $erro = $erro + 1;
                $type2 = "error";
                $message2 = "Erro na importação: " . $erro;
            }
        }
    }
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#frmCSVImport").on("submit", function() {
            $("#response").attr("class", "");
            $("#response").html("");
            var fileType = ".csv";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
            if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
                // $("#response").html("Arquivo invalido: <b>" + fileType + "</b> Ex. (1)");
                $("#response").html("Arquivo invalido: <b>" + fileType + "</b> Ex. (1)");
                return false;
            }
            return true;
        });
    });
</script>

<body>

<ul class="nav nav-tabs justify-content-center lighten-4 py-4">
<?php
$qsl_valida = "SELECT MAX(id) as id_valida FROM `db` where finalizado IS NULL;";

$recebidos = mysqli_query($conexao, $qsl_valida);

while ($rows = mysqli_fetch_assoc($recebidos)) {
    $id = $rows['id_valida'];
};
  
    if( $id == "" ){
    }else{
        ?>
        <li class="nav-item">
                    <a class="nav-link active" href="limpar_base.php">Limpar base que foi importada errada.</a>
                </li>
        <?php
    }
    ?> 
    </ul>

    <form class="form-horizontal" action="importar_csv.php" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
        <div class="flex-center flex-column">
            <!-- <h5>Acessar o link abaixo</h5> -->
            <h2>Importar como CSV</h2>

            <div id="response" class="<?php if (!empty($type1)) {
                                            echo $type1 . " display-block";
                                        } ?>"><?php if (!empty($message1)) {
                                                    echo $message1;
                                                } ?></div>
            <div id="response" class="<?php if (!empty($type2)) {
                                            echo $type2 . " display-block";
                                        } ?>"><?php if (!empty($message2)) {
                                                    echo $message2;
                                                } ?></div>
            <div id="response" class="<?php if (!empty($type3)) {
                                            echo $type3 . " display-block";
                                        } ?>"><?php if (!empty($message3)) {
                                                    echo $message3;
                                                } ?></div>

            <div class="outer-scontainer col-5">
                <div class="row-sm5">
                    <div class="input-row">
                        <div class="custom-file">
                            <input type="file" name="file" id="file" accept=".csv" class="custom-file-input" id="customFileLangHTML">
                            <label class="custom-file-label" for="customFileLangHTML" data-browse="Bucar">Selecionar Arquivo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-center flex-column">
            <div class="col-2">
                <!-- Material input -->
                <div class="md-form mt-0">
                    <button type="submit" name="import" class="btn btn-success">Importar</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</body>