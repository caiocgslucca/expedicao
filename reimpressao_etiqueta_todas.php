<?php
session_start();
include('barcode128.php');
// include('verifica_login.php');
error_reporting(E_ERROR | E_PARSE);
include('conexao.php');
date_default_timezone_set('America/recife');

$pedido = $_POST['pedido'];

$datahorahora = (date('d/m/Y H:i:s'));

// require __DIR__ . '/vendor/autoload.php';
// use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
// use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
// use Mike42\Escpos\PrintConnectors\FilePrintConnector;
// use Mike42\Escpos\Printer;

// $connector = new FilePrintConnector("php://stdout");
// $printer = new Printer($connector);

// $printer->initialize();
// $printer->setJustification(Printer::JUSTIFY_CENTER);
// $printer->text("Exemplo de impressão direta\n");
// $printer->cut();
// $printer->close();

// die();
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Etiqueta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<script src="css/JsBarcode.all.min.js"></script>

<!-- Largura (milímetros)	80
Altura (milímetros)	110 -->

<script>
  window.onload = function () {
    JsBarcode(".barcode").init();
  }
</script>

<!-- <style>
    body {
        width: 800px;
        height: 110px;
    }
</style> -->

<?php

// $recebidos2 = ("SELECT * FROM `db` WHERE pacote = '$pacote' and deleted_at IS NULL and finalizado IS NULL ");
$recebidos2 = ("SELECT * FROM `db` WHERE pedido = '$pedido' and deleted_at IS NULL and finalizado IS NULL ");
$recebidos3 = mysqli_query($conexao, $recebidos2);

while ($row = mysqli_fetch_assoc($recebidos3)) {

//   print_r($row);
//   die();
  $datahora = $row['data_hora'];
  $usuario = $row['usuario'];

  $pedido = $row['pedido'] . "  ";
  $nome_cliente = $row['nome_cliente'];
  $nota_fiscal = $row['nota_fiscal'];
  $box = $row['box'];
  $data_entrega = $row['data_entrega'];
  $carga = $row['carga'];
  $situacao = $row['situacao'];
  $qtd_itens = $row['qtd_itens'];
  $sku = $row['sku'];
  $descricao = $row['descricao'];
  $pacote = $row['pacote'];
  $regiao = $row['regiao'];
  $qtde = $row['qtde'];

?>
<body>
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-7">
        <h2 style="font-weight: 900;">
          <?php echo $nome_cliente ?>
        </h2>
      </div>
      <div class="col-4">
        <svg id="pedido"></svg>
        <script>
          JsBarcode("#pedido", "<?php echo $pedido; ?>", {
            // textAlign: "center",
            // textPosition: "top",
            font: "arial",
            fontOptions: "bold",
            textMargin: 5,
            height: 30,
            width: 2,
            fontSize: 10,
          });
        </script>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2" style="place-self: end;">
        <h4 style="font-weight: 900;">PV:</h4>
      </div>
      <div class="col-5" style="place-self: end;">
        <h2 style="font-weight: 900;">
          <?php echo $pedido ?>
        </h2>
      </div>
      <div class="col-2" style="place-self: end;">
        <h6 style="font-size: 50px; font-weight: 900;">BOX:</h6>
      </div>
      <div class="col-2">
        <h1> <b style="font-size: 100px;" >
            <?php echo $box ?>
          </b> </h1>
      </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-1" style="place-self: center;">
        <h5 style="font-weight: 900;">NF:</h5>
      </div>
      <div class="col-2" style="place-self: center;">
        <h3 style="font-weight: 900;" >
          <?php echo $nota_fiscal ?>
        </h3>
      </div>
      <div class="col-4" style="place-self: center;">
        <svg id="nota_fiscal"></svg>
        <script>
          JsBarcode("#nota_fiscal", "<?php echo $nota_fiscal; ?>", {
            // textAlign: "center",
            // textPosition: "top",
            font: "arial",
            fontOptions: "bold",
            textMargin: 5,
            height: 30,
            width: 2,
            fontSize: 10,
          });
        </script>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2" style="place-self: end;">
        <h5 style="font-weight: 900;" >SKU:</h5>
      </div>
      <div class="col-7" style="place-self: center;">
        <h2 style="font-weight: 900;">
          <?php echo $sku ?>
        </h2>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2" style="place-self: end;">
        <h5 style="font-weight: 900;" >PRODUTO:</h5>
      </div>
      <div class="col-7" style="place-self: center;">
        <h2 style="font-weight: 900;">
          <?php echo $descricao ?>
        </h2>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2">
       <h6 style="font-weight: 900;">QTD ITNES:</h6> 
      </div>
      <div class="col-2">
        <h5 style="font-weight: 900;"><?php echo $qtde . "/" . $qtd_itens ?></h5>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2">
        <h5 style="font-weight: 900;" >PACOTE:</h5>
      </div>
      <div class="col-4">
        <h5 style="font-weight: 900;" ><b><?php echo $pacote ?></b></h5>
      </div>
    </div>
    <div class="row justify-content-evenly">
      <div class="col-4">
        <svg id="pacote"></svg>
        <script>
          JsBarcode("#pacote", "<?php echo $pacote; ?>", {
            // textAlign: "center",
            // textPosition: "top",
            font: "arial",
            fontOptions: "bold",
            textMargin: 5,
            height: 30,
            width: 2,
            fontSize: 10,
          });
        </script>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2" style="place-self: end;">
        <h5 style="font-weight: 900;">CARGA:</h5>
      </div>
      <div class="col-4" style="place-self: end;">
        <h5 style="font-weight: 900;">
          <?php echo $carga ?>
        </h5>
      </div>
      <div class="col-4">
        <h3 style="font-weight: 900;">
          <?php echo $situacao ?>
        </h3>
      </div>
    </div>
    <div class="row justify-content-start">
      <div class="col-2" style="place-self: center;">
        <h5 style="font-weight: 900;" >REGIÃO:</h5>
      </div>
      <div class="col-4" style="place-self: center;">
        <h5 style="font-weight: 900;">
          <?php echo $regiao ?>
        </h5>
      </div>
    </div>
    <div class="row justify-content-evenly" style="background-color: currentcolor;color: black;">
      <div class="col-4">
        <h1 style="color: white; font-weight: 900;">
          <?php echo $data_entrega ?>
        </h1>
      </div>
    </div>
    <div class="row justify-content-end" style="background-color: currentcolor;color: black;">
      <div class="col-7">
        <h6 style="color: white; font-weight: 900;">Data hora impressão - <?php echo $datahorahora ?></h6>
      </div>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

<script>
       window.print();
</script>
       <?php 
       echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>";
       
    }
    echo '<meta http-equiv="refresh" content="0;URL=recebido.php" />';
?>