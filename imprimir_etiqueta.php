<?php
session_start();
include ('barcode128.php');
// include('verifica_login.php');
  // error_reporting(E_ERROR | E_PARSE);
  // include('conexao.php');

  date_default_timezone_set('America/recife');
  //date_default_timezone_set('America/Recife');


?>
<!-- Tamanho real da etiqueta -->
<!-- 3,70 -->
<!-- 1,0 -->

<!-- Deixar neste formato configuração da impressora -->
<!-- 5,00 -->
<!-- 1,40 -->

<!-- <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script> -->
<script src="css/JsBarcode.all.min.js"></script>

<script>
  window.onload = function() {
    JsBarcode(".barcode").init();
  }
</script>
</head>

<body>

</body>

</html>

<style>
  body {
    margin: 0mm;
  }

  div.op1 {
        /* width: 38%; */
        /* display: inline-block; */
        font-size: 11;
        text-align: center;
        font-weight: bold;
        /* padding: 1vw 0vw 1vw 0vw; */
        /* min-width:40vw; */
    }

</style>

<html>

<body>
<div class="op1">
    
      <?php
    
      $data = (date('d-m'));
      
      // print_r($biper);

      $usuario = $_SESSION['usuario'];

      $voucher = $_SESSION['voucher'];


      // echo $modelo = $_SESSION['modelo'] . " - " . $etiqueta = $_SESSION['etiqueta'];
      echo "<br>";


      ?>

      <svg id="barcode3"></svg>

      <script>
        JsBarcode("#barcode3", "<?php echo $biper; ?>", {
          textAlign: "center",
          // textPosition: "top",
          font: "arial",
          fontOptions: "bold",
          textMargin: 5,
          height: 30,
          width: 2,
          fontSize: 10,
          text: "<?php echo $biper; ?>"
        });
      </script>

      <?php
      echo "
      <script>
      window.print();
      setTimeout('window.close()', 10);
      </script>
      ";
      ?>
    </page>
  </div>
</div>
</body>

</html>