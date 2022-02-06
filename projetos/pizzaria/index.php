<?php require_once("conexao/conexao.php"); ?>
<?php include("_include/query_sabores.php"); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Seu Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="_css/data-anime.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
      body{ margin: 0; padding: 0}
      .pizza-cabecalho{transition: all ease-in 1s}
      .paragrafo{font-size: 20px;}
      .indent{text-indent: 15px}

      .promocoes-mensais{display: inline-block;margin-left: -300px;}
      @media screen and (max-width:600px) {
        .promocoes-mensais{visibility: hidden}
      }
      .background-cinza{background-color:rgb(238, 238, 238)}
      .cabecalho{background-image: url('_img/letrerodepizza.jpeg')}

      .pizza-fundo {background-image: url('_img/pizza-fundo.jpg'); background-position: 20% 10%}

      /* Em dispositivos mobile a div de pizza flutuante não será ixibida */
      @media screen and (max-width: 600px ) {
          .fatia-flutuante{display:none}

          /* alinhar o background do pizza-fundo */
          .pizza-fundo{ background-position: 40% 10%}
      }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark navbar-right fixed-top" data-anime="top">
        <a href="../index.html" class="navbar-brand ml-5">Pizzaria</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navegacao">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navegacao">
            <ul class="navbar-nav ml-auto text-center">
                
                <a href="pedido/index.php"><button class="btn btn-warning">Fazer meu pedido</button></a>                
                <li class="nav-item"><a href="index.php" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalcardapio">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
                <li class="nav-item"><a href="_admin/index.php" class="nav-link">ADM</a></li>
            </ul>
        </div>
    </nav>
    
    <header class="cabecalho bg-muted pt-5 pb-5 pizza-fundo">
        <div class="container">
            <div class="row pt-5 pb-2 ">
                <div class="col-md-7">
                    <h1 class="display-3 font-weight-bold text-uppercase" data-anime="left">Nós amamos pizza!</h1>
                    <p class="display-4 text-muted" data-anime="left">Venha experiêmentar a melhor comida do mundo.</p>
                    <button type="button" class="btn btn-warning btn-lg text-white mt-4" data-anime="left">Quero pedir minha pizza</button>
                </div>
                <div class="col-md-5 fatia-flutuante" data-anime="top">
                    <img src="_img/fatia-de-pizza-flutuante.png" class="img-fluid" class="pizza-cabecalho">
                </div>
            </div>
        </div>
    </header>
    
    <section>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-10 justify-content-between">
                    <header class=" pt-5 pb-5">
                        <h2 class="display-4  text-center">BEM VINDO AO NOSSO WEBSITE</h2>
                        <p class="text-center h4 text-muted">Você pode nesse site pedir sua própria pizza e encontrar informações sobre nós e diversas outras coisas.</p>
                    </header>
                </div>
            </div>

            <div class="row  pt-5 pb-5">
                <div class="col-md-6" data-anime="left">
                    <img src="_img/pizza-fatias.jpeg" alt="pizza em fatias" class="img-fluid rounded p-2" >
                </div>
                <div class="col-md-6  mt-4">
                    <h2 class="h1 mb-5">Forno a lenha</h2>
                    <p class="text-justify text-muted paragrafo indent">No forno a lenha, a madeira em combustão exala vapores aromáticos que se impregnam na pizza, em outras palavras, a pizza fica levemente defumada. Em comparação com os fornos caseiros a gás, a lenha tem uma vantagem adicional: a temperatura. Enquanto o forno caseiro fica em torno dos 300 graus, com a lenha obtemos uma temperatura constante de 550 graus. Assada mais rapidamente, a massa fica crocante por fora e macia por dentro.</p>
                    <button class="btn btn-warning btn-lg text-white mt-2" href="#">Ver mais</button>
                </div>

                <div class="col-md-6  mt-4">
                    <h2 class="h1 mb-5">Forno a lenha</h2>
                    <p class="text-justify text-muted paragrafo indent">No forno a lenha, a madeira em combustão exala vapores aromáticos que se impregnam na pizza, em outras palavras, a pizza fica levemente defumada. Em comparação com os fornos caseiros a gás, a lenha tem uma vantagem adicional: a temperatura. Enquanto o forno caseiro fica em torno dos 300 graus, com a lenha obtemos uma temperatura constante de 550 graus. Assada mais rapidamente, a massa fica crocante por fora e macia por dentro.</p>
                    <button class="btn btn-warning btn-lg text-white mt-2" href="#">Ver mais</button>
                </div>
                <div class="col-md-6 mt-4" data-anime="left">
                    <img src="_img/pizza-forno-a-lenha.jpeg" alt="pizza com forno a lenha" class="img-fluid rounded p-2">
                </div>
            </div>
        </div>
    </section>

    <!-- Promoção do mês -->
    <section class="pt-5 pb-5 background-cinza">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 p-5" data-anime="top">
                    <img src="_img/pizza-combo-familia.jpeg" alt="pessoas felizes" class="rounded img-fluid" >
                </div>
                <div class="col-md-6 p-5">
                    <h3 class=" display-4 text-uppercase text-center mb-5">Nossa promoção do mês</h3>
                    <p class="paragrafo text-muted indent">Pensando em você, sua familía e seus amigos, criamos uma promoção expecial.</p>
                    <p class="paragrafo text-muted indent">Na compre de duas pizzas grandes, gigantes ou tamanho familía, você ganha outra pizza to mesmo tamanho e mais um refrigerande de sua preferência.</p>
                    <div class="bg-white p-4 promocoes-mensais mt-5" data-anime="left">
                        <p class="paragrafo text-center">Está promoção durará até o final do mês.</p>
                        <p class="paragrafo text-center">Todo Mês com promoçãoes novos. Fique de olho</p>
                        <img src="_img/icone-pizza.png" alt="icone de pizza" class="d-block m-auto" width="200px">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--Produtos-->
    <section class="produtos pt-5 pb-5">
        <div class="container">
            <h2 class="display-4 text-center mt-5">Nossos produtos</h2>
            <p class="text-muted text-center h3  mb-5 pb-5">Conheça um pouco de nossas expecialidades da casa</p>
            <div class="row p-2">
                <div class="col-md-4" data-anime="left" style="transition: 0.3s">
                    <img src="_img/pizza-salgada.jpeg" alt="pizza salgada" width="100%">
                    <h3 class="text-center text-muted rounded">Pizza salgada</h3>
                </div>
                <div class="col-md-4" data-anime="left" style="transition: 1.5s">
                    <img src="_img/pizza-doce.jpg" alt="pizza doce" width="100%">
                    <h3 class="text-center text-muted rounded">Pizza salgada</h3>
                </div>
                <div class="col-md-4" data-anime="left" style="transition: 3s">
                    <img src="_img/calzone.jpeg" alt="foto de um calzone" width="100%">
                    <h3 class="text-center text-muted rounded">Calzones</h3>
                </div>    
            </div>
        </div>
    </section>

    <?php include("_include/sessao_cardapio.php"); ?>
    
    <?php include("_include/footer.php"); ?>

    <!-- animação -->
    <script src="_js/data-anime.js"></script>
</body>
</html>
