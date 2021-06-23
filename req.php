<?php include 'config.php';?>

<?php
	$pdo  = new PDO('mysql:host='.$servidor.';dbname='.$nome_banco.'', ''.$usuario.'', ''.$senha.'');
	$stmt = $pdo->prepare('select cod_cliente, nm_cliente, nr_cnpj from clientes where id_rede=? order by nm_cliente');
	$stmt->bindValue(1, ((int)$_POST['id_rede']), PDO::PARAM_INT);
	$stmt->execute();
	$resultCidade = $stmt->fetchAll();
//	sleep(2); // number of seconds to sleep
	$stmt->closeCursor();
	echo json_encode($resultCidade);
?>