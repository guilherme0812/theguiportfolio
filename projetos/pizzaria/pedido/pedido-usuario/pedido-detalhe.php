<?php require_once('../../conexao/conexao.php'); ?>

<?php
    /* Começo de teste de segurança */
    session_start();
    if (!isset($_SESSION["user_portal"]) ) { 
        header("location: ../../login/index.php");
    }// Fim do teste de segurança

    
    if(isset($_SESSION["user_portal"]) ){
        //Fazendo a query do registro do usuario que está logado
        include("../../_include/query_usuariologado.php");

        $nome_de_usuario =  $usuariologado["nome"]; 
        $nome;

        function retornarPrimeironome() {
            global $nome_de_usuario; //Diz que a variavel está no escopo global
            global $nome; //Diz que a variavel está no escopo global
            $pos = strpos($nome_de_usuario," "); //Encontra a posição da primeira ocorrencia de espaço

            if (empty($pos)) { // se não encontar espaços, $nome será igual a $nome_de_dados do banco de dados
                $nome = $nome_de_usuario;
            } else { //$nome será igual ao primeiro nome, ou seja até o primeiro espaço " ".
                $nome = substr($nome_de_usuario, 0, $pos);
            }
        }
        retornarPrimeironome();

        //Pegando a variavel via get
        $pedidoID = $_GET["codigo"];

        /*query de pedidos  */
        $q_pedidousuario = "SELECT * FROM pedidos ";
        $q_pedidousuario .= "WHERE pedidoID = '{$pedidoID}' ";
        $q_pedidousuario .= "ORDER BY data_pedido, horario_pedido";

        $pedidousuario = mysqli_query($conecta, $q_pedidousuario);
        $linha = mysqli_fetch_assoc($pedidousuario);

        function alterarCorCardPedido($estado) {
            if ($estado == "Pedido pendente") {
                return "bg-danger";
            } else if ($estado == "Pedido aceito" || $estado == "Pedido em produção" ||  $estado == "Saiu para entrega" ) {
                return "bg-warning";
            } else if ($estado == "Entregue") {
                return "bg-success";
            }
        }
    }
    include("../../_include/query_sabores.php");
    
?>
<?php
    /* FAZENDO UMA CONSULTA DAS TABELAS PRIMEIROSABOR SEGUNDOSABOR E TERCEIROSABOR */
    $q_primeirosabor = "SELECT * FROM sabores";
    $primeirosabor = mysqli_query($conecta,$q_primeirosabor);
    if (!$primeirosabor) {
        die("Erro na consulta ao banco");
    }
    $q_segundosabor = "SELECT * FROM sabores";
    $segundosabor = mysqli_query($conecta,$q_segundosabor);
    if (!$segundosabor){
        die("Erro na consulta ao banco");
    }
    $q_terceirosabor = "SELECT * FROM sabores";
    $terceirosabor = mysqli_query($conecta,$q_terceirosabor);
    if (!$terceirosabor){
        die("Erro na consulta ao banco");
    }

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
      
      .background-pizza{background-image: url('../../_img/servindo-pizza.jpeg'); background-position: center bottom}
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
                
                <li class="nav-item ml-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Bem vindo, <?php echo $nome ; ?> </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php">Meus pedidos</a>
                        <a class="dropdown-item" href="logout.php">Sair</a>
                    </div>
                </li>
                
                <li class="nav-item"><a href="../index.php" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalcardapio">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>
    
    
   <section class="pt-5">
    
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            
            <div class="col-md-3 mb-4">
                <div class="card rounded shadow">
                    <img src="../../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        <small class="float-right"><?php echo $linha["horario_pedido"]; ?> - <?php echo $linha["data_pedido"]; ?></small>
                        <h5>Pizza <?php echo $linha["tamanho"]; ?></h5>
                        
                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $linha["sabor1"] ); ?></li>
                            <li><?php echo utf8_encode( $linha["sabor2"] ); ?></li>
                            <li><?php echo utf8_encode( $linha["sabor3"] ); ?></li>
                        </ul>

                        <h6>Bebida:</h6>
                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $linha["bebida"] ); ?></li>
                            <li>Quantidade de bebidas: <?php echo utf8_encode( $linha["qnt_bebida"] ); ?></li>
                        </ul>
                    
                        <h6>Forma de pagamento:</h6>
                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $linha["forma_de_pagamento"] ); ?></li>
                            <li>Valor total: R$ <?php echo utf8_encode( $linha["valor_total"] ); ?></li>
                        </ul>

                        <div class="text-center shadow <?php echo alterarCorCardPedido(utf8_encode( $linha["estado_pedido"] )); ?> text-light rounded"><?php echo utf8_encode( $linha["estado_pedido"] ); ?></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
   </section>
   
   <?php include("../../_include/sessao_cardapio.php"); ?>

    <?php include_once("../../_include/footer.php"); ?>


    <!-- animação -->
    <script>
            const target = document.querySelectorAll('[data-anime]'); //seleciona os elementos com data-anime
            const animationClass = 'animate';
    
            function animeScroll () {
                const windowTop = window.pageYOffset + (window.innerHeight * 3 ) / 4;//verifica a distancia da barra de scroll e o top do site 
                target.forEach(function(element) {
                    if ( (windowTop) > element.offsetTop) {
                        element.classList.add(animationClass);
                    }
    
                    console.log(element.offsetTop);
                })
            }
            //todo vez que move o scroll chama a função animeScroll()
            window.addEventListener('scroll', function() {
                animeScroll();
            })
    
            window.onload( animeScroll() );
    </script>
    
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
