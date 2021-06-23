<?php

//nome do site
$site = '4.3.2.15/devolucoes';

//nome do banco de dados
$servidor = "localhost";
$nome_banco = "devolucoes";
$usuario = "sensacao";
$senha = "Galo1305$";

$con = mysqli_connect($servidor,$usuario,$senha,$nome_banco);
// Check connection
if (mysqli_connect_error())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_select_db($con,$nome_banco);

?>
