<?php
session_start();
include('conexao.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])) {
	header('Location: index.php');
	exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select usuario from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";
// echo $query;
// exit();
$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if ( "123" == $senha) {
  echo "<script> alert (' ( $usuario ) Favor alterar a senha ela esta como padrão de acesso')</script>";
  echo '<meta http-equiv="refresh" content="1;URL=perdipassword.php" />';  
  // header('Location: perdipassword.php');
exit();

} else {


if($row == 1) {
	$_SESSION['usuario'] = $usuario;
	header('Location: destino.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: login.php');
	exit();
}
}
?>