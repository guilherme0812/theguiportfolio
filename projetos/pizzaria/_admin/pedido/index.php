<?php require_once('../../conexao/conexao.php'); ?>

<?php
    /* Começo de teste de segurança */
    session_start();
    if (!isset($_SESSION["user_admin"]) ) { 
        header("location: ../../login/index.php");
    }
    // Fim do teste de segurança
    
    if(isset($_SESSION["user_portal"]) ){
        unset($_SESSION["user_portal"]);
    }

    date_default_timezone_set("America/Sao_Paulo");
    /*query de pedidos  */
    $q_pedidos = "SELECT * FROM pedidos ";

    /* query número de pedidos */
    $q_numeropedidos    = "SELECT count(*), data_pedido FROM pedidos ";
    
    if ( !empty($_POST["data"]) ) {
        $date = $_POST["data"];
        $q_pedidos .= "WHERE data_pedido = '{$date}' "; // vai mostrar somente do dia atual

        $q_numeropedidos    .= "WHERE data_pedido = '{$date}' ";//SE tiver dado em post ele vai filtar o n°
    } else {
        $q_pedidos = "SELECT * FROM pedidos ";

        $q_numeropedidos    = "SELECT count(*), data_pedido FROM pedidos ";
    }

    $q_pedidos .= "ORDER BY pedidoID DESC ";

    $pedidos = mysqli_query($conecta, $q_pedidos);

    /* consultando o número de pedidos no banco de dados */
    $numeropedidos      = mysqli_query($conecta, $q_numeropedidos);
    if (!$numeropedidos) {
        die("Erro na consulta de contagem");
    }
    $array_numeropedido = mysqli_fetch_assoc($numeropedidos); //tranformando em array

    /* Se tiver algum valor vindo pelo POST o input de selct vai ser alterado pra "selected" ou naõ*/
    $selected;
    if (!empty($_POST["data"])) {
        $selected = "selected";
    } else {
        $selected = "";
    }


    //QUERY DE SABORES PARA O MODAL
    include_once("../../_include/query_sabores.php"); 

    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Seu Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../_css/data-anime.css">
  <link href="../../_css/muestilo.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <style>
      .background-cinza{background-color:rgb(238, 238, 238)}
      
      .background-pizza-desfocada{background-image: url('../../_img/servindo-pizza-desfocada.jpeg'); background-position: center bottom}
  </style>
</head>
<body>
    <!--Navegação -->
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-right fixed-top" data-anime="top">
        <a href="../../index.php" class="navbar-brand ml-5">Pizzaria</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacao">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navegacao">
            
            <ul class="navbar-nav ml-auto text-center">
                <a href="../index.php"><button class="btn btn-warning">Fazer pedido</button></a> 
                <li class="nav-item ml-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Bem vindo, <?php// echo $nome ; ?> </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php">Meus pedidos</a>
                        <a class="dropdown-item" href="../login/logout.php">Sair</a>
                    </div>
                </li>
                
                <li class="nav-item"><a href="../index.php" class="nav-link">PAINEL</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalcardapio">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>
    
   <section class="pt-5 ">
    
    <div class="container mt-5">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="input-group mb-2">
                <select class="form-control" name="data">
                    <option value="">Todos pedidos</option>
                    <option value="<?php echo date("y-m-d"); ?>" <?php echo $selected;  ?>>Somente de hojê</option>
                </select>
                <div class="input-group-prepend">
                    <button class="btn btn-primary">Buscar</button>
                </div>
            </div>

        </form>

        <div>
            <h5>Total de pedidos : <?php echo $array_numeropedido["count(*)"]; ?></h5>
        </div>

        <div class="row">
            <?php while($linha = mysqli_fetch_assoc($pedidos) ){ ?>
            <div class="col-md-3 mb-4">
                <div class="card shadow">
                    <img src="../../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        <small class="float-right"><?php echo $linha["horario_pedido"]; ?> - <?php echo $linha["data_pedido"]; ?></small>
                        <h5>Pizza <?php echo $linha["tamanho"]; ?></h5>
                        

                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $linha["sabor1"] ); ?></li>
                            <li><?php echo utf8_encode( $linha["sabor2"] ); ?></li>
                            <li><?php echo utf8_encode( $linha["sabor3"] ); ?></li>
                        </ul>
                        <a href="pedido-detalhe.php?pedido=<?php echo $linha["pedidoID"]; ?>"><button class="btn btn-outline-primary">Ver mais detalhes</button></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    
   </section>

   <?php include_once("../../_include/sessao_cardapio.php"); ?>

    <?php include_once("../../_include/footer.php"); ?>


    <!-- animação -->
    <script src="../../_js/data-anime.js"></script>
    
</body>
</html>

<?php
    /*
    mysqli_free_result($primeirosabor);
    mysqli_free_result($segundosabor);
    mysqli_free_result($terceirosabor);
    */
    mysqli_close($conecta);
?>
