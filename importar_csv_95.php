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
    <title>Query 95</title>
</head>

<?php

if (isset($_POST["import"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");
        $ok = 0;
        $erro = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

            //             $sqlInsert = "INSERT INTO `dymo2`(
            //                 `id`, `voucher`, `Marca`, `Modelo`, `produto_declarado`, 
            //                 `Condicao_Declarada`, `imei_declarado`, `valorcompra`, 
            //                 `id_status`, `usuario`, `data_hora`) VALUES

            // (NULL, '$column[0]','$column[10]','$column[11]','$column[12]','$column[16]','$column[18]','$column[30]',
            // '$id_status','$usuario','$datahora')";

            $search  = array_map('trim',array("'", '"','R$', '/','\\'));

            $array_salvar = str_replace($search, " ",  $column);

            $rest = substr($array_salvar[2], -15);

            $sqlInsert = "INSERT INTO `dymo2`(
                    `id`, `voucher`, `position`, `Marca`, `Modelo`, `produto_declarado`, 
                     `Condicao_Declarada`, `imei_declarado`, `valorcompra`, 
                     `id_status`, `chave`, `usuario`, `data_hora`) VALUES
                    (NULL, '$rest', '$array_salvar[5]', '$array_salvar[11]', '$array_salvar[10]', '$array_salvar[1]', '$array_salvar[6]', '$array_salvar[2]', '$array_salvar[8]',
                    '$id_status', '', '$usuario', '$datahora')";


            if ($array_salvar[0] == 'product_id' ||  $array_salvar[0] == '')
                continue;
            $result = mysqli_query($conexao, $sqlInsert);

            // echo "<br>";
            // echo $sqlInsert;
            // echo "<br>";

            if ($result == 1) {
                //  echo "<br>";
                //  echo $sqlInsert;
                //  echo "<br>";

                $ok = $ok + 1;
                $type1 = "success";
                $message1 = "Importado com sucesso: " . $ok;
            } else {
                $erro = $erro + 1;
                $type2 = "error";
                $message2 = "Erro na importação: " . $erro;

                // $update =  "UPDATE `dymo2` SET
                // `imei_declarado`= '$column[2]',
                // `position` = ''$column[5]'',
                // `Marca`= '$column[11]',
                // `Modelo`= '$column[10]',
                // `produto_declarado`= '$column[1]',
                // `Condicao_Declarada`= '$column[6]',
                // `valorcompra` = '$column[8]',
                // `data_hora` = '$datahora'
                // WHERE  `voucher` = '$rest'";
                // $updateresult = mysqli_query($conexao, $update);

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
            var fileType = ".txt";
            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
            if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
                $("#response").html("Arquivo invalido: <b>" + fileType + "</b> Ex. (1)");
                return false;
            }
            return true;
        });
    });
</script>

<body>
    <form class="form-horizontal" action="importar_csv_95.php" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
        <div class="flex-center flex-column">
            <h5>Acessar o link abaixo</h5>
            <h5><?php echo "<a href='http://redash.trocafone.net/api/queries/95/results.csv?api_key=f674dc5894c63e138f7152a0e5ee3e3828ed9fdc' target='_blank' >Queries/95</a>"; ?></h5>
            <h6>Baixar como CSV</h6>

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
                            <input type="file" name="file" id="file" accept=".txt" class="custom-file-input" id="customFileLangHTML">
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