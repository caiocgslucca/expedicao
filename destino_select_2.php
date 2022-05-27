<?php
session_start();
$destino = $_POST['destino'];
$_SESSION['destino'] = $destino;
header('Location: destino_select.php');
?>