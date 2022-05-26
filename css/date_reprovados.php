<!-- <div style="padding-left:20px"> -->
<?PHP
error_reporting(E_ERROR | E_PARSE);
session_start();
//include('header.php');
include('conexao.php');
include 'barcode128.php';
include('header_reprovados.php');
include('verifica_login.php');
date_default_timezone_set('America/Sao_Paulo');
$datahora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['usuario'];
$id_status = 1;
$rev= "revisão";
?>

<!doctype html>
    <div style="padding-left:20px">
          <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
          <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
          <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
          <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
          <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
          <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
          <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
          <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
          <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
          <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="doc/jquery.min.js"></script>
            <link rel="stylesheet" href="doc/bootstrap.min.css">
            <link rel="stylesheet" href="doc/bootstrap-select.css">
            <script src="doc/bootstrap-select.js"></script>
            <script src="doc/bootstrap.min.js"></script>
            <link rel="stylesheet" href="doc/jquery-ui.css">  
            <script src="doc/jquery-ui.js"></script>


<script >
    
  $( function() {              
                $( "fieldset" ).controlgroup({
                  icon: false
                });
              });

</script>

<html>
<head>
    <meta charset="utf-8" />
    <title>Calendário</title>    
</head>
<body>
<br>

<form action="date_reprovados.php" method="post">
<p>

Data inicial: <input autocomplete = off type="text" name="date"   id="calendario" />
Data final:   <input autocomplete = off type="text" name= "date2" id="calendario2" />

<?php

$nivel = $_SESSION['usuario'];
$nivel_necessario = 1;

$sql = "SELECT `usuario`, `nivel` FROM `usuario` WHERE (`usuario` = '".$nivel ."') AND (`nivel` = '". ($nivel_necessario) ."') LIMIT 1";
$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) != 1) {
    // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
    //echo "Usuário sem acesso a esta página"; exit;
    //echo "<script> alert (' ( $nivel )  sem acesso aos filtros!')</script>";
   // echo '<meta http-equiv="refresh" content="0;URL=importardados.php" />';
  

?>

<label >Usuario:</label>
<?php

$select_recebidos2 = ("SELECT usuario.usuario, usuario.setor FROM usuario where setor ='$rev' ORDER BY `usuario`.`usuario` ASC ");
$recebidos2 = mysqli_query($conexao, $select_recebidos2);

?>       
<select multiple data-live-search="true" class="selectpicker"  data-live-search="true" name="usuario[]" style="width:15rem" >
    <!-- <option disabled >Selecionar um usuário</option>
    <option select > simone.rodrigues</option>
    <option>Edy.silva</option>
    <option>rosicleia.amorim</option>
    <option>phelipe.silveira</option> -->
   <option selected><?php Echo $usuario ?></option>
   
    <!-- <?php while($prod = mysqli_fetch_array($recebidos2)) { ?>
    <option value="<?php echo $prod['usuario'] ?>"><?php echo $prod['usuario'] ?></option>

     <?php } ?> -->

  </select>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<input type="submit" value="Buscar">
</p>

 </body>
</html>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>

  </script>
</head>
<body>
  
 
</body>
</html>


<html>
<div style="padding-left:20px">
<head>
<style>
table {
  border-collapse: collapse;
  width: 90%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #000000;
  color: white;
}
</style>
</head>
</div>
</html>

<script>


$(function() {
    $("#calendario").datepicker({
    	dateFormat: 'yy-mm-dd 00:00:00',
        showOtherMonths: true,
        selectOtherMonths: true,
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>
<script>
$(function() {
    $("#calendario2").datepicker({
    	dateFormat: 'yy-mm-dd 23:59:59',
        showOtherMonths: true,
        selectOtherMonths: true,
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>


</form>

               

<?php
// $select_recebidos = ("SELECT * FROM `testefull` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal'ORDER BY `data_hora` DESC ");
// echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a>'."<br><br>";

// $select_recebidos =("SELECT * FROM `testefull` WHERE `usuario` = '$livro' AND `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC");
// echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal. '& usuario='.$livro.   '">Clique aqui para fazer o download</a>'."<br><br>";


$datainicio = $_POST["date"];
$datafinal = $_POST["date2"];
$usuario = $_POST["usuario"];

if (empty($_POST["date"])){
                       
 $vazio = "";
 
echo "<script> alert ('ATENÇÃO SELECIONAR UM PERÍODO!')</script>";

 $select_recebidos = ("SELECT * FROM `rep_reprovados`
ORDER BY `rep_reprovados`.`data_hora` DESC");
// $busca =("SELECT `id`, `voucher`, `fun`,`imei_declarado`, `produto_declarado`, `id_status`, `usuario`, `data_hora` FROM `dymo` WHERE `fun` <> 'BYPASS' AND `id_status` = 2 ORDER BY `dymo`.`data_hora` DESC");

$recebidos = mysqli_query($conexao, $select_recebidos);

$ok = 0;
    //crie uma variável para receber o código da tabela
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
    $ok ++;
        /*loop deve terminar aqui*/
      }
           echo "Quantidade de IMEI:     ". $ok ."<br><hr>";


    if(isset($_SESSION['msg'])){
      echo $_SESSION['msg'];
      unset($_SESSION['msg']);
    }
    
    //Receber o número da página
    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);   
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    
    //Setar a quantidade de itens por pagina
    $qnt_result_pg = 10;
    
    //calcular o inicio visualização
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;


//$select_recebidos = ("SELECT * FROM `reparosucata`");

$select_recebidos = ("SELECT * FROM `rep_reprovados` ORDER BY `data_hora` DESC LIMIT $inicio, $qnt_result_pg ");

//$select_recebidos =("SELECT * FROM `reparosucata` ORDER BY `reparosucata`.`data_hora` DESC");

$recebidos = mysqli_query($conexao, $select_recebidos);


$tabela = '<table border = 1 CELLSPACING = 6>'; //abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    // $tabela .= '<th>AÇÃO</th>';
    $tabela .= '<th>IMEI</th>'; // colunas do cabeçalho

    $tabela .= '<th>Condicao</th>'; // colunas do cabeçalho
    $tabela .= '<th>Modelo</th>'; // colunas do cabeçalho
    $tabela .= '<th>Marca</th>'; // colunas do cabeçalho
    $tabela .= '<th>Produto</th>'; // colunas do cabeçalho 

    $tabela .= '<th>Tecnico</th>'; // colunas do cabeçalho
    $tabela .= '<th>Setor</th>'; // colunas do cabeçalho
    $tabela .= '<th>CQS</th>'; // colunas do cabeçalho
    $tabela .= '<th>Defeito</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>'; // colunas do cabeçalho
    $tabela .= '<th>Outros defeitos</th>'; // colunas do cabeçalho
    $tabela .= '<th>Usuario</th>'; // colunas do cabeçalho
    $tabela .= '<th>Data hora</th>'; // colunas do cabeçalho


    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $tabela .= '<tr>'; // abre uma linha
        
        $tabela .= '<td>\''.$row_usuario['imei'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['condicao'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['modelo'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['marca'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['produto'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['tecnico'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['setor'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['cqs'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['defeito'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['resultado'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['outrosdefeitos'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['usuario'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.date('d/m/Y H:i:s',strtotime($row_usuario['data_hora'])).'</td>'; // coluna Alvara


        $tabela .= '</tr>'; // fecha linha
        /*loop deve terminar aqui*/
      }
        $tabela .='</tbody>'; //fecha corpo
        $tabela .= '</table>';//fecha tabela
        echo $tabela; // imprime
        

    $result_pg = "SELECT COUNT(id) AS num_result FROM `rep_reprovados` ORDER BY `data_hora` DESC";
    $resultado_pg = mysqli_query($conexao, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    //echo $row_pg['num_result'];
    //Quantidade de pagina 
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
    
    //Limitar os link antes depois
    
    $max_links = 5;
    echo "<a href='date_reprovados.php?pagina=1'>Primeira</a> ";
    
    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
      if($pag_ant >= 1){
        echo "<a href='date_reprovados.php?pagina=$pag_ant'>$pag_ant</a> ";
      }
    }
      
    echo "$pagina ";
    
    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
      if($pag_dep <= $quantidade_pg){
    
        echo "<a href='date_reprovados.php?pagina=$pag_dep'>$pag_dep</a> ";
      }
    }
    
    // echo  "Todas de paginas             ".$quantidade_pg;
    echo "<a href='date_reprovados.php?pagina=$quantidade_pg'>Ultima</a>";
  
  } else{

    if (empty($_POST['usuario'])){
      $usa = "";

    $select_recebidos = ("SELECT * FROM `rep_reprovados` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal'ORDER BY `data_hora` DESC ");
    $recebidos = mysqli_query($conexao, $select_recebidos);
    
    $ok = 0;
        //crie uma variável para receber o código da tabela
        while($row_usuario = mysqli_fetch_assoc($recebidos)){
        $ok ++;
            /*loop deve terminar aqui*/
          }
               echo "Quantidade de IMEI:     ". $ok ."<br><hr>";

$select_recebidos = ("SELECT * FROM `rep_reprovados` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal'ORDER BY `data_hora` DESC ");
echo ' <td><a button class="btn btn-success" href= "export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a></td>'."<br><br>";



 if(isset($_SESSION['msg'])){
  echo $_SESSION['msg'];
  unset($_SESSION['msg']);
}

//Receber o número da página
$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);   
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

//Setar a quantidade de itens por pagina
$qnt_result_pg = 10;

//calcular o inicio visualização
$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;


//$select_recebidos = ("SELECT * FROM `reparosucata`");

$select_recebidos = ("SELECT * FROM `rep_reprovados` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC LIMIT $inicio, $qnt_result_pg ");

//$select_recebidos =("SELECT * FROM `reparosucata` ORDER BY `reparosucata`.`data_hora` DESC");

$recebidos = mysqli_query($conexao, $select_recebidos);


$tabela = '<table border = 1 CELLSPACING = 6>'; //abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    // $tabela .= '<th>AÇÃO</th>';
    $tabela .= '<th>IMEI</th>'; // colunas do cabeçalho

    $tabela .= '<th>Condicao</th>'; // colunas do cabeçalho
    $tabela .= '<th>Modelo</th>'; // colunas do cabeçalho
    $tabela .= '<th>Marca</th>'; // colunas do cabeçalho
    $tabela .= '<th>Produto</th>'; // colunas do cabeçalho 

    $tabela .= '<th>Tecnico</th>'; // colunas do cabeçalho
    $tabela .= '<th>Setor</th>'; // colunas do cabeçalho
    $tabela .= '<th>CQS</th>'; // colunas do cabeçalho
    $tabela .= '<th>Defeito</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>'; // colunas do cabeçalho
    $tabela .= '<th>Outros defeitos</th>'; // colunas do cabeçalho
    $tabela .= '<th>Usuario</th>'; // colunas do cabeçalho
    $tabela .= '<th>Data hora</th>'; // colunas do cabeçalho


    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $tabela .= '<tr>'; // abre uma linha
        
        $tabela .= '<td>\''.$row_usuario['imei'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['condicao'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['modelo'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['marca'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['produto'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['tecnico'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['setor'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['cqs'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['defeito'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['resultado'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['outrosdefeitos'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['usuario'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.date('d/m/Y H:i:s',strtotime($row_usuario['data_hora'])).'</td>'; // coluna Alvara


        $tabela .= '</tr>'; // fecha linha
        /*loop deve terminar aqui*/
      }
        $tabela .='</tbody>'; //fecha corpo
        $tabela .= '</table>';//fecha tabela
        echo $tabela; // imprime
        
$result_pg = "SELECT COUNT(id) AS num_result FROM `rep_reprovados` ORDER BY `data_hora` DESC";
$resultado_pg = mysqli_query($conexao, $result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);
//echo $row_pg['num_result'];
//Quantidade de pagina 
$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

//Limitar os link antes depois

$max_links = 5;
echo "<a href='date_reprovados.php?pagina=1'>Primeira</a> ";

for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
  if($pag_ant >= 1){
    echo "<a href='date_reprovados.php?pagina=$pag_ant'>$pag_ant</a> ";
  }
}
  
echo "$pagina ";

for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
  if($pag_dep <= $quantidade_pg){

    echo "<a href='date_reprovados.php?pagina=$pag_dep'>$pag_dep</a> ";
  }
}

// echo  "Todas de paginas             ".$quantidade_pg;
echo "<a href='date_reprovados.php?pagina=$quantidade_pg'>Ultima</a>";

  }else{

   
      if(!empty($_POST['usuario'])){          
      $usuario = implode("; ", $_POST['usuario']);    
      $linhas_redash = explode("\n", $usuario);
      foreach($linhas_redash as $linha_redash) {
      $uas = explode(";" , $linha_redash);


      $select_recebidos =("SELECT * FROM `rep_reprovados` WHERE `tecnico` = '$usuario' AND `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC");      
      $recebidos = mysqli_query($conexao, $select_recebidos);
      
      $ok = 0;
          //crie uma variável para receber o código da tabela
          while($row_usuario = mysqli_fetch_assoc($recebidos)){
          $ok ++;
              /*loop deve terminar aqui*/
            }
                 echo "Quantidade de IMEI:     ". $ok ."<br><hr>";

$select_recebidos =("SELECT * FROM `rep_reprovados` WHERE `tecnico` = '$usuario' AND `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC");
// echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal. '& usuario='.$usuario.   '">Clique aqui para fazer o download</a>'."<br><br>";
echo ' <td><a button class="btn btn-success" href= "export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a></td>'."<br><br>";

$recebidos = mysqli_query($conexao, $select_recebidos);

$tabela = '<table border = 1 CELLSPACING = 6>'; //abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    // $tabela .= '<th>AÇÃO</th>';
    $tabela .= '<th>IMEI</th>'; // colunas do cabeçalho

    $tabela .= '<th>Condicao</th>'; // colunas do cabeçalho
    $tabela .= '<th>Modelo</th>'; // colunas do cabeçalho
    $tabela .= '<th>Marca</th>'; // colunas do cabeçalho
    $tabela .= '<th>Produto</th>'; // colunas do cabeçalho 

    $tabela .= '<th>Tecnico</th>'; // colunas do cabeçalho
    $tabela .= '<th>Setor</th>'; // colunas do cabeçalho
    $tabela .= '<th>CQS</th>'; // colunas do cabeçalho
    $tabela .= '<th>Defeito</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>'; // colunas do cabeçalho
    $tabela .= '<th>Outros defeitos</th>'; // colunas do cabeçalho
    $tabela .= '<th>Usuario</th>'; // colunas do cabeçalho
    $tabela .= '<th>Data hora</th>'; // colunas do cabeçalho


    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $tabela .= '<tr>'; // abre uma linha
        
        $tabela .= '<td>\''.$row_usuario['imei'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['condicao'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['modelo'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['marca'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['produto'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['tecnico'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['setor'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['cqs'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['defeito'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['resultado'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['outrosdefeitos'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['usuario'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.date('d/m/Y H:i:s',strtotime($row_usuario['data_hora'])).'</td>'; // coluna Alvara


        $tabela .= '</tr>'; // fecha linha
        /*loop deve terminar aqui*/
      }
        $tabela .='</tbody>'; //fecha corpo
        $tabela .= '</table>';//fecha tabela
        echo $tabela; // imprime
        
$result_pg = "SELECT COUNT(id) AS num_result FROM `rep_reprovados` ";
$resultado_pg = mysqli_query($conexao, $result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);
//echo $row_pg['num_result'];
//Quantidade de pagina 
$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

//Limitar os link antes depois

$max_links = 5;
// echo "<a href='date_reprovados.php?pagina=1'>Primeira</a> ";

for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
  if($pag_ant >= 1){
    echo "<a href='date_reprovados.php?pagina=$pag_ant'>$pag_ant</a> ";
  }
}
  
// echo "$pagina ";

for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
  if($pag_dep <= $quantidade_pg){

    // echo "<a href='date_reprovados.php?pagina=$pag_dep'>$pag_dep</a> ";
  }
}

// echo  "Todas de paginas             ".$quantidade_pg;
// echo "<a href='date_reprovados.php?pagina=$quantidade_pg'>Ultima</a>";

}
      }
      }
  }
exit;
} else {
  # code...
?>

  <label >Usuario:</label>
  <?php
  
  $select_recebidos2 = ("SELECT usuario.usuario, usuario.setor FROM usuario where setor ='$rev' ORDER BY `usuario`.`usuario` ASC ");
  $recebidos2 = mysqli_query($conexao, $select_recebidos2);
  
  ?>       
  <select multiple data-live-search="true" class="selectpicker"  data-live-search="true" name="usuario[]" style="width:15rem" >
      <!-- <option disabled >Selecionar um usuário</option>
      <option select > simone.rodrigues</option>
      <option>Edy.silva</option>
      <option>rosicleia.amorim</option>
      <option>phelipe.silveira</option> -->
     <option selected><?php Echo $usuario ?></option>
     
       <?php while($prod = mysqli_fetch_array($recebidos2)) { ?>
      <option value="<?php echo $prod['usuario'] ?>"><?php echo $prod['usuario'] ?></option>
  
       <?php } ?>
  
    </select>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <input type="submit" value="Buscar">
  </p>
  
   </body>
  </html>
  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
  <!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Datepicker - Default functionality</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
  
    </script>
  </head>
  <body>
    
   
  </body>
  </html>
  
  
  <html>
  <div style="padding-left:20px">
  <head>
  <style>
  table {
    border-collapse: collapse;
    width: 90%;
  }
  
  th, td {
    text-align: left;
    padding: 8px;
  }
  
  tr:nth-child(even){background-color: #f2f2f2}
  
  th {
    background-color: #000000;
    color: white;
  }
  </style>
  </head>
  </div>
  </html>
  
  <script>
  
  
  $(function() {
      $("#calendario").datepicker({
        dateFormat: 'yy-mm-dd 00:00:00',
          showOtherMonths: true,
          selectOtherMonths: true,
          dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
          dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
          dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
          monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
          monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
      });
  });
  </script>
  <script>
  $(function() {
      $("#calendario2").datepicker({
        dateFormat: 'yy-mm-dd 23:59:59',
          showOtherMonths: true,
          selectOtherMonths: true,
          dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
          dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
          dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
          monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
          monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
      });
  });
  </script>
  
  
  </form>
  
                 
  
  <?php
  // $select_recebidos = ("SELECT * FROM `testefull` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal'ORDER BY `data_hora` DESC ");
  // echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a>'."<br><br>";
  
  // $select_recebidos =("SELECT * FROM `testefull` WHERE `usuario` = '$livro' AND `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC");
  // echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal. '& usuario='.$livro.   '">Clique aqui para fazer o download</a>'."<br><br>";
  
  
  $datainicio = $_POST["date"];
  $datafinal = $_POST["date2"];
  $usuario = $_POST["usuario"];
  
  if (empty($_POST["date"])){
                         
   $vazio = "";
   
  echo "<script> alert ('ATENÇÃO SELECIONAR UM PERÍODO!')</script>";
  
   $select_recebidos = ("SELECT * FROM `rep_reprovados` ORDER BY `rep_reprovados`.`data_hora` DESC");
  // $busca =("SELECT `id`, `voucher`, `fun`,`imei_declarado`, `produto_declarado`, `id_status`, `usuario`, `data_hora` FROM `dymo` WHERE `fun` <> 'BYPASS' AND `id_status` = 2 ORDER BY `dymo`.`data_hora` DESC");
  
  
  $recebidos = mysqli_query($conexao, $select_recebidos);
  
  $ok = 0;
      //crie uma variável para receber o código da tabela
      while($row_usuario = mysqli_fetch_assoc($recebidos)){
      $ok ++;
          /*loop deve terminar aqui*/
        }
             echo "Quantidade de IMEI:     ". $ok ."<br><hr>";
  
  
      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      
      //Receber o número da página
      $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);   
      $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
      
      //Setar a quantidade de itens por pagina
      $qnt_result_pg = 10;
      
      //calcular o inicio visualização
      $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
  
  
  //$select_recebidos = ("SELECT * FROM `reparosucata`");
  
  $select_recebidos = ("SELECT * FROM `rep_reprovados` ORDER BY `data_hora` DESC LIMIT $inicio, $qnt_result_pg ");
  
  //$select_recebidos =("SELECT * FROM `reparosucata` ORDER BY `reparosucata`.`data_hora` DESC");
  
  $recebidos = mysqli_query($conexao, $select_recebidos);
  
  $tabela = '<table border = 1 CELLSPACING = 6>'; //abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    // $tabela .= '<th>AÇÃO</th>';
    $tabela .= '<th>IMEI</th>'; // colunas do cabeçalho

    $tabela .= '<th>Condicao</th>'; // colunas do cabeçalho
    $tabela .= '<th>Modelo</th>'; // colunas do cabeçalho
    $tabela .= '<th>Marca</th>'; // colunas do cabeçalho
    $tabela .= '<th>Produto</th>'; // colunas do cabeçalho 

    $tabela .= '<th>Tecnico</th>'; // colunas do cabeçalho
    $tabela .= '<th>Setor</th>'; // colunas do cabeçalho
    $tabela .= '<th>CQS</th>'; // colunas do cabeçalho
    $tabela .= '<th>Defeito</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>'; // colunas do cabeçalho
    $tabela .= '<th>Outros defeitos</th>'; // colunas do cabeçalho
    $tabela .= '<th>Usuario</th>'; // colunas do cabeçalho
    $tabela .= '<th>Data hora</th>'; // colunas do cabeçalho


    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $tabela .= '<tr>'; // abre uma linha
        
        $tabela .= '<td>\''.$row_usuario['imei'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.($row_usuario['condicao']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['modelo']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['marca']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['produto']).'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['tecnico'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['setor']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['cqs'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['defeito']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['resultado']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.($row_usuario['outrosdefeitos']).'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['usuario'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.date('d/m/Y H:i:s',strtotime($row_usuario['data_hora'])).'</td>'; // coluna Alvara


        $tabela .= '</tr>'; // fecha linha
        /*loop deve terminar aqui*/
      }
        $tabela .='</tbody>'; //fecha corpo
        $tabela .= '</table>';//fecha tabela
        echo $tabela; // imprime
    
          
      $result_pg = "SELECT COUNT(id) AS num_result FROM `rep_reprovados` ORDER BY `data_hora` DESC";
      $resultado_pg = mysqli_query($conexao, $result_pg);
      $row_pg = mysqli_fetch_assoc($resultado_pg);
      //echo $row_pg['num_result'];
      //Quantidade de pagina 
      $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
      
      //Limitar os link antes depois
      
      $max_links = 5;
      echo "<a href='date_reprovados.php?pagina=1'>Primeira</a> ";
      
      for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
        if($pag_ant >= 1){
          echo "<a href='date_reprovados.php?pagina=$pag_ant'>$pag_ant</a> ";
        }
      }
        
      echo "$pagina ";
      
      for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
        if($pag_dep <= $quantidade_pg){
      
          echo "<a href='date_reprovados.php?pagina=$pag_dep'>$pag_dep</a> ";
        }
      }
      
      // echo  "Todas de paginas             ".$quantidade_pg;
      echo "<a href='date_reprovados.php?pagina=$quantidade_pg'>Ultima</a>";
    
    } else{
  
      if (empty($_POST['usuario'])){
        $usa = "";
  
      $select_recebidos = ("SELECT * FROM `rep_reprovados` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal'ORDER BY `data_hora` DESC ");
      $recebidos = mysqli_query($conexao, $select_recebidos);
      
      $ok = 0;
          //crie uma variável para receber o código da tabela
          while($row_usuario = mysqli_fetch_assoc($recebidos)){
          $ok ++;
              /*loop deve terminar aqui*/
            }
                 echo "Quantidade de IMEI:     ". $ok ."<br><hr>";
  
  $select_recebidos = ("SELECT * FROM `rep_reprovados` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal'ORDER BY `data_hora` DESC ");
//   echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a>'."<br><br>";
echo ' <td><a button class="btn btn-success" href= "export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a></td>'."<br><br>";
   
  
   if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
  }
  
  //Receber o número da página
  $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);   
  $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
  
  //Setar a quantidade de itens por pagina
  $qnt_result_pg = 10;
  
  //calcular o inicio visualização
  $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
  
  
  //$select_recebidos = ("SELECT * FROM `reparosucata`");
  
  $select_recebidos = ("SELECT * FROM `rep_reprovados` WHERE `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC LIMIT $inicio, $qnt_result_pg ");
  
  //$select_recebidos =("SELECT * FROM `reparosucata` ORDER BY `reparosucata`.`data_hora` DESC");
  
  $recebidos = mysqli_query($conexao, $select_recebidos);
  
  
  $tabela = '<table border = 1 CELLSPACING = 6>'; //abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    // $tabela .= '<th>AÇÃO</th>';
    $tabela .= '<th>IMEI</th>'; // colunas do cabeçalho

    $tabela .= '<th>Condicao</th>'; // colunas do cabeçalho
    $tabela .= '<th>Modelo</th>'; // colunas do cabeçalho
    $tabela .= '<th>Marca</th>'; // colunas do cabeçalho
    $tabela .= '<th>Produto</th>'; // colunas do cabeçalho 

    $tabela .= '<th>Tecnico</th>'; // colunas do cabeçalho
    $tabela .= '<th>Setor</th>'; // colunas do cabeçalho
    $tabela .= '<th>CQS</th>'; // colunas do cabeçalho
    $tabela .= '<th>Defeito</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>'; // colunas do cabeçalho
    $tabela .= '<th>Outros defeitos</th>'; // colunas do cabeçalho
    $tabela .= '<th>Usuario</th>'; // colunas do cabeçalho
    $tabela .= '<th>Data hora</th>'; // colunas do cabeçalho


    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $tabela .= '<tr>'; // abre uma linha
        
        $tabela .= '<td>\''.$row_usuario['imei'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['condicao'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['modelo'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['marca'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['produto'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['tecnico'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['setor'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['cqs'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['defeito'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['resultado'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['outrosdefeitos'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['usuario'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.date('d/m/Y H:i:s',strtotime($row_usuario['data_hora'])).'</td>'; // coluna Alvara


        $tabela .= '</tr>'; // fecha linha
        /*loop deve terminar aqui*/
      }
        $tabela .='</tbody>'; //fecha corpo
        $tabela .= '</table>';//fecha tabela
        echo $tabela; // imprime
        
  $result_pg = "SELECT COUNT(id) AS num_result FROM `rep_reprovados` ORDER BY `data_hora` DESC";
  $resultado_pg = mysqli_query($conexao, $result_pg);
  $row_pg = mysqli_fetch_assoc($resultado_pg);
  //echo $row_pg['num_result'];
  //Quantidade de pagina 
  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
  
  //Limitar os link antes depois
  
  $max_links = 5;
  echo "<a href='date_reprovados.php?pagina=1'>Primeira</a> ";
  
  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
    if($pag_ant >= 1){
      echo "<a href='date_reprovados.php?pagina=$pag_ant'>$pag_ant</a> ";
    }
  }
    
  echo "$pagina ";
  
  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
    if($pag_dep <= $quantidade_pg){
  
      echo "<a href='date_reprovados.php?pagina=$pag_dep'>$pag_dep</a> ";
    }
  }
  
  // echo  "Todas de paginas             ".$quantidade_pg;
  echo "<a href='date_reprovados.php?pagina=$quantidade_pg'>Ultima</a>";
  
    }else{
  
     
        if(!empty($_POST['usuario'])){          
        $usuario = implode("; ", $_POST['usuario']);    
        $linhas_redash = explode("\n", $usuario);
        foreach($linhas_redash as $linha_redash) {
        $uas = explode(";" , $linha_redash);
  
  
        $select_recebidos =("SELECT * FROM `rep_reprovados` WHERE `tecnico` = '$usuario' AND `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC");      
        $recebidos = mysqli_query($conexao, $select_recebidos);
        
        $ok = 0;
            //crie uma variável para receber o código da tabela
            while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $ok ++;
                /*loop deve terminar aqui*/
              }
                   echo "Quantidade de IMEI:     ". $ok ."<br><hr>";
  
  $select_recebidos =("SELECT * FROM `rep_reprovados` WHERE `tecnico` = '$usuario' AND `data_hora` BETWEEN '$datainicio' AND '$datafinal' ORDER BY `data_hora` DESC");
//   echo '<a href= "'.'export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal. '& usuario='.$usuario.   '">Clique aqui para fazer o download</a>'."<br><br>";
echo ' <td><a button class="btn btn-success" href= "export_reprovados.php?dateini='.$datainicio .'& datefinal='.$datafinal.    '">Clique aqui para fazer o download</a></td>'."<br><br>";
  

  $recebidos = mysqli_query($conexao, $select_recebidos);
  
  $tabela = '<table border = 1 CELLSPACING = 6>'; //abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr>';//abre uma linha
    // $tabela .= '<th>AÇÃO</th>';
    $tabela .= '<th>IMEI</th>'; // colunas do cabeçalho

    $tabela .= '<th>Condicao</th>'; // colunas do cabeçalho
    $tabela .= '<th>Modelo</th>'; // colunas do cabeçalho
    $tabela .= '<th>Marca</th>'; // colunas do cabeçalho
    $tabela .= '<th>Produto</th>'; // colunas do cabeçalho 

    $tabela .= '<th>Tecnico</th>'; // colunas do cabeçalho
    $tabela .= '<th>Setor</th>'; // colunas do cabeçalho
    $tabela .= '<th>CQS</th>'; // colunas do cabeçalho
    $tabela .= '<th>Defeito</th>'; // colunas do cabeçalho
    $tabela .= '<th>Resultado</th>'; // colunas do cabeçalho
    $tabela .= '<th>Outros defeitos</th>'; // colunas do cabeçalho
    $tabela .= '<th>Usuario</th>'; // colunas do cabeçalho
    $tabela .= '<th>Data hora</th>'; // colunas do cabeçalho


    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
    while($row_usuario = mysqli_fetch_assoc($recebidos)){
            $tabela .= '<tr>'; // abre uma linha
        
        $tabela .= '<td>\''.$row_usuario['imei'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['condicao'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['modelo'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['marca'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['produto'].'</td>'; // coluna Alvara
        
        $tabela .= '<td>'.$row_usuario['tecnico'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['setor'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['cqs'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['defeito'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['resultado'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['outrosdefeitos'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.$row_usuario['usuario'].'</td>'; // coluna Alvara
        $tabela .= '<td>'.date('d/m/Y H:i:s',strtotime($row_usuario['data_hora'])).'</td>'; // coluna Alvara


        $tabela .= '</tr>'; // fecha linha
        /*loop deve terminar aqui*/
      }
        $tabela .='</tbody>'; //fecha corpo
        $tabela .= '</table>';//fecha tabela
        echo $tabela; // imprime
        
  $result_pg = "SELECT COUNT(id) AS num_result FROM `rep_reprovados` ";
  $resultado_pg = mysqli_query($conexao, $result_pg);
  $row_pg = mysqli_fetch_assoc($resultado_pg);
  //echo $row_pg['num_result'];
  //Quantidade de pagina 
  $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
  
  //Limitar os link antes depois
  
  $max_links = 5;
  // echo "<a href='date_reprovados.php?pagina=1'>Primeira</a> ";
  
  for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
    if($pag_ant >= 1){
      echo "<a href='date_reprovados.php?pagina=$pag_ant'>$pag_ant</a> ";
    }
  }
    
  // echo "$pagina ";
  
  for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
    if($pag_dep <= $quantidade_pg){
  
      // echo "<a href='date_reprovados.php?pagina=$pag_dep'>$pag_dep</a> ";
    }
  }
  
  // echo  "Todas de paginas             ".$quantidade_pg;
  // echo "<a href='date_reprovados.php?pagina=$quantidade_pg'>Ultima</a>";
  
  }
        }
        }
    }
  


}

  ?>