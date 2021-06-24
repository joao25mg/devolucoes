<?php include "../config.php"; ?>

<?php

//Parametro para retornar o cod da devolução
$busca = mysqli_query($con, "select * from parametros where id_parametro = 1" ) or trigger_error('Erro ao executar consutla. Detalhes = ' . mysqli_error());
$cod_dev = mysqli_fetch_array($busca);
//Retorna o nome da rede
$busca2 = mysqli_query($con, "select * from redes where id_rede = '".$_POST['rede']."'" ) or trigger_error('Erro ao executar consutla. Detalhes = ' . mysqli_error());
$nome_rede = mysqli_fetch_array($busca2);

$sql = "INSERT INTO devolucoes(
cod_devolucao,
nr_nota,
dt_emissao,
nm_rede,
nm_cliente,
nm_produto,
nr_lote,
dt_validade,
nr_quantidade,
nr_unidade,
nm_motivo
)
VALUES (
'".$cod_dev['valor']."',
'".$_POST['nota']."',
'".$_POST['data_emissao']."',
'".$nome_rede['nm_rede']."',
'".$_POST['cliente']."',
'".$_POST['produto']."',
'".$_POST['lote']."',
'".$_POST['data_validade']."',
'".$_POST['quantidade']."',
'".$_POST['unidade']."',
'".$_POST['motivo']."'
)";

//echo $sql;
//Executo a minha query
//echo $sql;
$query = mysqli_query($con, $sql);
sleep(2); // number of seconds to sleep


$arquivo = $_FILES["foto_arquivo_produto"]["tmp_name"]; 
$tamanho = $_FILES["foto_arquivo_produto"]["size"];
$tipo    = $_FILES["foto_arquivo_produto"]["type"];
$nome  = $_FILES["foto_arquivo_produto"]["name"];

if ( $arquivo != "none" )
{
  $fp = fopen($arquivo, "rb");
  $conteudo = fread($fp, $tamanho);
  $conteudo = addslashes($conteudo);
  fclose($fp);                 
  
  //Insere a imagem da nota
  try { 
    $conecta = new PDO("mysql:host=$servidor;dbname=$nome_banco", $usuario , $senha); //istancia a classe PDO
    $comandoSQL = "INSERT INTO foto_produto VALUES (0,'".$cod_dev['valor']."','$nome','$conteudo','$tipo')";
    $grava = $conecta->prepare($comandoSQL); //testa o comando SQL
    $grava->execute(array()); 	                                        
      echo '<br/><div class="alert alert-success" role="alert">
            Foto da nota enviado com sucesso para o servidor!
            </div>';
  } catch(PDOException $e) { // caso retorne erro               
    echo '<br/><div class="alert alert-success" role="alert">
          Erro ' . $e->getMessage() . 
          '</div>';
    }
}


$arquivo2 = $_FILES["foto_arquivo_nota"]["tmp_name"]; 
$tamanho2 = $_FILES["foto_arquivo_nota"]["size"];
$tipo2    = $_FILES["foto_arquivo_nota"]["type"];
$nome2  = $_FILES["foto_arquivo_nota"]["name"];

if ( $arquivo2 != "none" )
{
  $fp2 = fopen($arquivo2, "rb2");
  $conteudo2 = fread($fp2, $tamanho2);
  $conteudo2 = addslashes($conteudo2);
  fclose($fp2);                 

  //Insere a imagem do produto
  try { 
    $conecta2 = new PDO("mysql:host=$servidor;dbname=$nome_banco", $usuario , $senha); //istancia a classe PDO
    $comandoSQL2 = "INSERT INTO foto_nota VALUES (0,'".$cod_dev['valor']."','$nome2','$conteudo2','$tipo2')";
    $grava2 = $conecta2->prepare($comandoSQL2); //testa o comando SQL
    $grava2->execute(array()); 	                                        
      echo '<br/><div class="alert alert-success" role="alert">
            Foto do produto enviado com sucesso para o servidor!
            </div>';
  } catch(PDOException $f) { // caso retorne erro               
    echo '<br/><div class="alert alert-success" role="alert">
          Erro ' . $f->getMessage() . 
          '</div>';
    }
}


//Verifico se o registro foi inserido com sucesso
if ($query == true) {
  //Altera o parametro 1 de inserção do codigo da devolução
  mysqli_query($con, "UPDATE parametros SET valor = '$cod_dev[valor]'+1 WHERE id_parametro = 1");
  
  echo "<script>alert('Devolução cadastrada com sucesso');</script>";
  echo "<META http-equiv='refresh' content='1;URL=http://".$site."/index.php'> ";
  
  
}
else {
  echo "Não foi possivel inserir o registro - entre em contato com o webmaster <br><br>";
}

?>