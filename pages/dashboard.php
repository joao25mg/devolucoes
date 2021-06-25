<!DOCTYPE html>
<html lang="pt-br">
    
    <?php include '../config.php';?>

<?php
    $busca = mysqli_query($con, "SELECT * FROM devolucoes ORDER BY cod_devolucao DESC");

    if (mysqli_num_rows($busca)==0) { //Se nao achar nada, lança essa mensagem
        echo "<h3 align='center'>";
      
        echo "Nenhum registro encontrado.";
         
        echo "</h3>";
        }
?>

<header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Devoluções Sensação</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</header>

<body>
    <!-- Begin Page Content -->
    <div class="container-fluid" style="padding-left: 50px; padding-right: 50px">

    <!-- Page Heading -->
    <br/>
    <!-- Logo sensação -->
        <img src="../img/logo.png" class="mx-auto d-block" alt="..." width="250em" height="auto" style="margin-bottom: -20px; margin-top: -20px">
    <h1 class="h3 mb-2 text-gray-800" align="center">Devoluções</h1>
    <br/><br/>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Devoluções Cadastrados</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th  width="10%">Cod. Devolução</th>
                <th  width="20%">Rede</th>
                <th  width="50%">Cliente</th>
                <th  width="10%">Nota Fiscal</th>
            </tr>
            </thead>
            <tbody>
            <?php 
                while ($dados = mysqli_fetch_array($busca)) {
            ?>
                <tr>
                    <td><?php echo $dados['cod_devolucao']; ?></td>
                    <td><?php echo $dados['nm_rede']; ?></td>
                    <td><?php echo $dados['nm_cliente']; ?></td>
                    <td><?php echo $dados['nr_nota']; ?></td>
                </tr>
                    <?php
                }
                ?>
                <?php
            ?>
            </tbody>
        </table>
        </div>
    </div>
    </div>

    </div>
    <!-- /.container-fluid -->

</body>

</html>