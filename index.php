<!DOCTYPE html>
<html lang="pt-br">
    <?php include 'config.php';?>

<!-- Busca redes para retornar clientes -->
    <?php
        $pdo  = new PDO('mysql:host='.$servidor.';dbname='.$nome_banco.'', ''.$usuario.'', ''.$senha.'');
        $stmt = $pdo->prepare('select id_rede, nm_rede from redes order by nm_rede');
        $stmt->execute();
        $resultUf = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt->closeCursor();
    ?>

<!-- Busca Redes -->
    <?php
          $buscaR = mysqli_query($con, "select * from redes" ) or trigger_error('Erro ao executar consutla. Detalhes = ' . mysqli_error());

        if (mysqli_num_rows($buscaR)==0) { //Se nao achar nada, lança essa mensagem
          echo "<h3 align='center'>";
          echo "Nenhum registro encontrado.";    
          echo "</h3>";
        }else{
      ?>

<!-- Busca Clientes -->
    <?php
          $buscaC = mysqli_query($con, "select * from clientes" ) or trigger_error('Erro ao executar consutla. Detalhes = ' . mysqli_error());

        if (mysqli_num_rows($buscaC)==0) { //Se nao achar nada, lança essa mensagem
          echo "<h3 align='center'>";
          echo "Nenhum registro encontrado.";    
          echo "</h3>";
        }else{
      ?>

<!-- Busca Motivos -->
    <?php
          $buscaM = mysqli_query($con, "select * from motivos" ) or trigger_error('Erro ao executar consutla. Detalhes = ' . mysqli_error());

        if (mysqli_num_rows($buscaM)==0) { //Se nao achar nada, lança essa mensagem
          echo "<h3 align='center'>";
          echo "Nenhum registro encontrado.";    
          echo "</h3>";
        }else{
      ?>

<!-- Busca Produtos -->
    <?php
          $buscaP = mysqli_query($con, "select * from produtos" ) or trigger_error('Erro ao executar consutla. Detalhes = ' . mysqli_error());

        if (mysqli_num_rows($buscaP)==0) { //Se nao achar nada, lança essa mensagem
          echo "<h3 align='center'>";
          echo "Nenhum registro encontrado.";    
          echo "</h3>";
        }else{
      ?>

<header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Devoluções Sensação</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7/jquery.min.js"></script>	
    <script type="text/javascript" src="js/clone.js"></script>	
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</header>
<body>
    </br>
    <img src="img/logo.png" class="mx-auto d-block" alt="..." width="250em" height="auto" style="margin-bottom: -70px">
<!-- Formulário -->
    <form id="regForm" enctype="multipart/form-data" name="regForm" action="dao/cad_devolucao.php" method="post">
        <h1>Devolução de Vendas</h1>

        <!-- One "tab" for each step in the form: -->
        <div class="tab">
        </br>
<!-- Campo Número da nota -->
        <label>Número da nota</label>
        <p><input class="col form-control" id="nota" name="nota" type="number" placeholder="Número da nota"></p>
<!-- Campo Data emissão -->
        <label>Data de emissão</label>
            <p><input class="col form-control" id="data_emissao" name="data_emissao" type="date" value='<?php echo date("Y-m-d"); ?>' placeholder="Data de emissão"></p>
<!-- Campo Rede -->
        <label>Rede</label>
            <p>
                <select class="col form-control" id="rede" name="rede">
                    <option selected>Selecione uma rede</option>
                    <?php foreach ($resultUf as $uf) : ?>
                        <option value="<?php echo $uf->id_rede;?>"><?php echo $uf->nm_rede;?></option>
                    <?php endforeach;} ?>
                </select>
            </p>
<!-- Campo Cliente -->
        <label>Cliente</label>
            <p>
                <?php } ?>
                <select class="col form-control" id="cliente" name="cliente">
                </select>
            </p>
        </div>
        <div class="tab">
        </br>
        <div id="origem">
<!-- Campo Produto -->
            <label>Produto</label>
                <p>
                    <select class="col form-control" id="produto" name="produto">
                        <option selected>Selecione um poduto</option>
                        <?php 
                            while ($dadosP = mysqli_fetch_array($buscaP)) {
                                ?>
                        <option value="<?php echo $dadosP['cod_produto']. " - " .$dadosP['nm_produto']; ?>">
                            <?php echo $dadosP['cod_produto']. " - " .$dadosP['nm_produto']; ?>
                        </option>
                        <?php
                            }}
                            ?>
                    </select>
                </p>
<!-- Campo Lote -->
            <label>Lote</label>
            <p><input class="col form-control" id="lote" name="lote" placeholder="Lote"></p>
<!-- Campo Validade -->
            <label>Data de validade</label>
                <p><input class="col form-control" id="data_validade" name="data_validade" type="date" value='<?php echo date("Y-m-d"); ?>' placeholder="Data de validade"></p>
<!-- Campo Quantidade -->
            <label>Quantidade (Kg)</label>
                <p><input class="col form-control" id="quantidade" name="quantidade" type="number" placeholder="Quantidade"></p>
<!-- Campo Unidade -->
            <label>Unidade</label>
                <p><input class="col form-control" id="unidade" name="unidade" type="number" placeholder="Unidade"></p>
<!-- Campo Motivo da devolução -->
            <label>Motivo da devolução</label>
                <p>
                    <select class="col form-control" id="motivo" name="motivo">
                        <option selected>Selecione um motivo</option>
                        <?php 
                            while ($dadosM = mysqli_fetch_array($buscaM)) {
                                ?>
                        <option value="<?php echo $dadosM['nm_motivo']; ?>">
                            <?php echo $dadosM['nm_motivo']; ?>
                        </option>
                        <?php
                            }}
                            ?>
                    </select>
                </p>
        </br>
        </div>
        <div id="destino">
        </div>
        <div align="center">
            <img src="./img/add.png" style="cursor: pointer; width: 35px" onclick="duplicarCampos();">&nbsp&nbsp&nbsp
            <!-- Botão para remover campos produtos
            <img  src="./img/sub.png" style="cursor: pointer; width: 35px" onclick="removerCampos(this);">
            -->
        </div>
        </div>

        <div class="tab">
<!-- Campo Foto da nota -->
            <label>Foto da nota</label>
            <p><input type="file" name="foto_arquivo_nota" id="foto_arquivo_nota" class="col form-control" placeholder="Foto da Nota"></p>
<!-- Campo Foto do produto -->
            <label>Foto do produto</label>
            <p><input type="file" name="foto_arquivo_produto" id="foto_arquivo_produto" class="col form-control" placeholder="Foto do produto"></p>
        </div>
        </br>
<!-- Botões avançar e voltar -->
        <div style="overflow:auto;">
            <div  align="center">
                <button type="button" class="btn btn-warning" id="prevBtn" onclick="nextPrev(-1)">Voltar</button>&nbsp&nbsp
                <button type="button"  class="btn btn-warning" id="nextBtn" onclick="nextPrev(1)">Avançar</button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:20px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        </div>

    </form>

    <script src="js/min_step.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
        (function() {
            'use strict'

            if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement('style')
                msViewportStyle.appendChild(
                    document.createTextNode(
                        '@-ms-viewport{width:auto!important}'
                    )
                )
                document.head.appendChild(msViewportStyle)
            }

        }())

    </script>
  	<script type="text/javascript">
  		$(document).ready(function()
  		{
  			$("#rede").change(function()
  			{
  				var value = $(this).val();
  				$.post("req.php", {id_rede:value}, function(result){
  					$("#cliente").empty();
  					if (result)
  					{
  						var options = '';
  						$.each(result, function(i,v)
  						{
  							options = options + '<option value="'+ v.nm_cliente +' - '+ v.nr_cnpj +'">'+ v.nm_cliente + ' - ' + v.nr_cnpj +'</option>'
  						});
  						$("#cliente").html(options);
  					}
  				}, "json");
  			});
  		})
  	</script>
</body>
</html>
<?php
	unset($pdo);
?>