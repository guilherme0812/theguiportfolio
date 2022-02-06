<?php require_once('../conexao/conexao.php'); ?>

<?php
    /* Começo de teste de segurança */
    session_start();
    if (!isset($_SESSION["user_admin"]) ) { 
        header("location: login/index.php");
    } 
    // Fim do teste de segurança

    /*if(isset($_SESSION["user_portal"]) ){
        unset($_SESSION["user_portal"]);
    }*/
    
    //QUERY DE SABORES PARA O MODAL
    include_once("../_include/query_sabores.php"); 
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
    .menu-scroll {
        overflow: auto;
        white-space: nowrap;
        }

    .menu-scroll .item {
        display: inline-block;
        text-align: center;
        padding: 14px;
        text-decoration: none;
        }
  </style>
</head>
<body>
    <!--Navegação -->
    
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-right fixed-top" data-anime="top">
        <a href="../index.php" class="navbar-brand ml-5">Pizzaria</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacao">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navegacao">
            
            <ul class="navbar-nav ml-auto text-center">
                <a href="../pedido/index.php"><button class="btn btn-warning">Fazer pedido</button></a> 
                <li class="nav-item ml-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" > Adiministrador </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="login/logout.php">Sair</a>
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
        <div class="menu-scroll">

            <div class="col-10 col-md-3 mb-4 item">
                <div class="card shadow">
                    <img src="../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Sessão de pedidos</h5>
                        <a href="pedido/index.php"><button class="btn btn-outline-primary">Abrir pedidos</button></a>
                    </div>
                </div>
            </div>

            <div class="col-10 col-md-3 mb-4 item">
                <div class="card shadow">
                    <img src="../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Inserir novo sabor</h5>
                        <a href="inserir_sabor/index.php"><button class="btn btn-outline-primary">inserir sabor</button></a>
                    </div>
                </div>
            </div>

            <div class="col-10 col-md-3 mb-4 item">
                <div class="card shadow">
                    <img src="../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Consultar clientes</h5>
                        <a href="clientes/index.php"><button class="btn btn-outline-primary">Consultar</button></a>
                    </div>
                </div>
            </div>

            <div class="col-10 col-md-3 mb-4 item">
                <div class="card shadow">
                    <img src="../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        
                        <a href="#"><button class="btn btn-outline-primary">Ver mais detalhes</button></a>
                    </div>
                </div>
            </div>

            <div class="col-10 col-md-3 mb-4 item">
                <div class="card shadow">
                    <img src="../_img/foto-pizza-tirada-de-cima.jpg" class="card-img-top">
                    <div class="card-body">
                        
                        <a href="#"><button class="btn btn-outline-primary">Ver mais detalhes</button></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
   </section>

    <?php include_once("../_include/sessao_cardapio.php"); ?>

    <?php include_once("../_include/footer.php"); ?>


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
