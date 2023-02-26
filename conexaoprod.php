<?php

// ****** Docker
$host = "localhost";
$user = "u103814480_u840968102_zet";
$pass = "Controle360gra@";
$banco = "u103814480_controle360gra";
$conexao = mysqli_connect($host, $user, $pass, $banco) or die ('Não foi possível conectar') ;

mysqli_set_charset($conexao,"utf8");

?>