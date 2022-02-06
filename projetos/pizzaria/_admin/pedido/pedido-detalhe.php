<?php require_once('../../conexao/conexao.php'); ?>

<?php
    /* Começo de teste de segurança */
    session_start();
    if (!isset($_SESSION["user_admin"]) ) { 
        header("location: ../../login/index.php");
    }
    // Fim do teste de segurança
    
    /*if(isset($_SESSION["user_portal"]) ){
        unset($_SESSION["user_portal"]);
    }*/

    
    if(isset($_SESSION["user_admin"]) ){

        //Pegando a variavel via get
        $pedidoID = $_GET["pedido"];

        /*fazendo query de pedido com a variavel pedidoID vindo pelo m´todo GET */
        $q_pedidousuario = "SELECT * FROM pedidos ";
        $q_pedidousuario .= "WHERE pedidoID = '{$pedidoID}' ";

        $pedidousuario = mysqli_query($conecta, $q_pedidousuario);
        $pedido = mysqli_fetch_assoc($pedidousuario);

        /* Fazendo query de usuario com o fk_usuario do $pedido */
        $q_usuario = "SELECT * FROM usuarios ";
        $q_usuario .= "WHERE usuarioID = '{$pedido["fk_usuario"]}' ";
        
        $usuariodopedido = mysqli_query($conecta, $q_usuario);
        if (!$usuario) {
            die ("Erro ao consultar o usuario no banco de dados");
        }
        $usuario = mysqli_fetch_assoc($usuariodopedido);        
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        print_r($_POST);
        //Alterar estado do pedido
        $estado_pedido  = $_POST["estado_pedido"];
        $fk_usuario      = utf8_decode($_POST["fk_usuario"]);

        $q_estadopedido = "UPDATE pedidos SET estado_pedido = '{$estado_pedido}' ";
        $q_estadopedido .= " WHERE fk_usuario = '{$fk_usuario}' ";
        $alterarestadopedido = mysqli_query($conecta, $q_estadopedido);
        if (!$alterarestadopedido) {
            die("Erro ao alterar o estado do pedido");
        } else {
            header("location: ../index.php");
        }
    }
    //Função para marcar select no estado de pedido
    function marcarSelect ($estado) {// Essa função faz que o genero do usuario venha selecionado no formulario
        global $pedido;
        
        
        if ($estado == $pedido["estado_pedido"] ) {
            return "selected";
        }    
    }

    include_once("../../_include/query_sabores.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Seu Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../_css/data-anime.css">
  <link href="../../_css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <style>
      .background-cinza{background-color:rgb(238, 238, 238)}
      .background-pizza-desfocada{background-image: url('../../_img/servindo-pizza-desfocada.jpg'); background-position: center bottom}
      .clear{clear: both}
  </style>
</head>
<body>
    <!--Navegação 
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-right fixed-top" data-anime="top">
        <a href="../../index.php" class="navbar-brand ml-5">Pizzaria</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacao">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navegacao">
            <ul class="navbar-nav ml-auto text-center">
                
                <li class="nav-item ml-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Bem vindo </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php">Meus pedidos</a>
                        <a class="dropdown-item" href="../login/logout.php">Sair</a>
                    </div>
                </li>
                
                <li class="nav-item"><a href="index.php" class="nav-link">VOLTAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalcardapio">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>
    -->
   <section class="pt-5 pb-5 background-pizza-desfocada">
    
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            
            <div class="col-md-6 mb-4">
                <div class="card shadow opacity">
                    
                    <div class="card-body">
                        <small class="float-right"><?php echo $pedido["horario_pedido"]; ?> - <?php echo $pedido["data_pedido"]; ?></small>
                        <h5 class="border-bottom">Pizza <?php echo $pedido["tamanho"]; ?></h5>
                        
                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $pedido["sabor1"] ); ?></li>
                            <li><?php echo utf8_encode( $pedido["sabor2"] ); ?></li>
                            <li><?php echo utf8_encode( $pedido["sabor3"] ); ?></li>
                        </ul>

                        <h6 class="border-bottom">BEBIDA:</h6>
                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $pedido["bebida"] ); ?></li>
                            <li>Quantidade de bebidas: <?php echo utf8_encode( $pedido["qnt_bebida"] ); ?></li>
                        </ul>
                    
                        <h6 class="border-bottom">FORMA DE PAGAMENTO:</h6>
                        <ul class="list-unstyled">
                            <li><?php echo utf8_encode( $pedido["forma_de_pagamento"] ); ?></li>
                            <li>Valor total: R$ <?php echo utf8_encode( $pedido["valor_total"] ); ?></li>
                        </ul>

                        <h6 class="border-bottom">INFORMAÇÕES DE USUÁRIO: </h6>
                        <ul class="list-unstyled float-md-left">
                            <li>Nome: <?php echo utf8_encode( $usuario["nome"]); ?></li>
                            <li>Telefone: <?php echo utf8_encode( $usuario["telefone"]);  ?></li>
                            <li>Endereço: <?php echo utf8_encode( $usuario["endereco"]);  ?></li>
                            <li>Endereço: <?php echo utf8_encode( $usuario["bairro"]);  ?></li>
                            <li></li>
                        </ul>
                        <img src="../../_img/o.png" class="d-none d-md-block float-md-right w-25 ">

                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" >

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="fk_usuario" value="<?php echo $pedido["fk_usuario"] ?>">
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    
                                    <select class="form-control" name="estado_pedido">
                                        <option value="Pedido pendente"     <?php echo marcarSelect("pedido pendente"); ?> >Pedido pendente...</option>
                                        <option value="Pedido aceito"       <?php echo marcarSelect("Pedido aceito"); ?> >Aceitar pedido</option>
                                        <option value="Pedido em produção"  <?php echo marcarSelect("Pedido em produção"); ?> >Pedido em produção</option>
                                        <option value="Saiu para entrega"   <?php echo marcarSelect("Saiu para entrega"); ?> >Saiu para entrega</option>
                                        <option value="Entregue"            <?php echo marcarSelect("Entregue"); ?> >Finalizado!</option>
                                    </select>

                                    <div class="input-group-prepend">
                                        <button class="btn btn-warning btn-sm" type="submit">Alterar estado do pedido</button>
                                    </div>

                                </div>
                            </div>

                        </form>

                        <div class="clear"></div>
                        <div class="text-center clear-left mt-3">
                            <button class="btn btn-outline-primary m-auto">Imprimir agora</button>
                        </div>

                        
                    </div>
                    <div class="card-footer">
                        <img src="../../_img/foto-pizza-tirada-de-cima.jpg" class="card-img">
                    </div>
                     
                </div>
            </div>
            
        </div>
    </div>
    
   </section>

    <?php include_once("../../_include/sessao_cardapio.php"); ?>

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
