<?php require_once("../../conexao/conexao.php"); ?>
<?php 
    //Iniciando variavel de sessão
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario    = $_POST["usuario"] ; //Recebendo email do formulario
        $senha      = $_POST["senha"]; //Recebendo senha do formulario

        /* query de login, verifica se o email e senha são os mesmos que estão no banco de dados */
        $q_login = "SELECT * ";
        $q_login .= "FROM administradores ";
        $q_login .= "WHERE usuario = '{$usuario}' and senha = '{$senha}' ";

        $login = mysqli_query($conecta,$q_login); // consulta ao banco de dados de login
        if (!$login) {
            die ("Falha na consulta ao banco de dados");
        }

        $informacao = mysqli_fetch_assoc($login);
        if ( empty($informacao) ) { //Verifica se a variavel $informação está vazia
            $mensagem_de_erro = "* Não foi possivel fazer login";
        } else{
            //print_r($informacao);
            $_SESSION["user_admin"] = $informacao["administradorID"];
            header("location: ../index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Seu Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../_css/data-anime.css">
  <link rel="stylesheet" href="../../_css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link href="../_css/style.css" rel="stylesheet">
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
                <li class="nav-item"><a href="../index.html" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link">CARDAPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>
    
    <section class="cadastro background-pizza pt-5 pb-5 pl-2 pr-2">
        <div class="container pb-5">
            <div class="row justify-content-md-center">
                <div class="col-md-6 pb-5 mt-5 mb-5 bg-white rounded opacity">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="mt-3">

                        <h1 class=" display-4 text-center">Área de login</h1>
                        <p class="paragrafo text-center text-muted mb-5">Faça login para entrar no painel de administrador</p>

                        <div class="form-group mb-5">
                            <span class="text-danger"><?php if(isset($mensagem_de_erro) ){ echo $mensagem_de_erro ;} ?></span>
                            <input type="text" name="usuario" class="form-control mb-5" placeholder="Digite aqui seu E-mail" required onmousemove="recolherNumero(-1)">
                            <input type="password" id="senha" name="senha" minlength="8" maxlength="255" class="form-control mb-3" placeholder="Digite aqui sua senha" required oninput="recolherNumero(1)">
                        </div>
        
                        <button type="submit" name="enviar" id="botaoDeEnviar" class="btn btn-success btn-block">Fazer Login</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include("../../_include/footer.php"); ?>
    
    <script>
        var imagemMacaco = document.getElementById('imagemMacaco');
        var i = 1;
        
        function recolherNumero(n) {
            mudarFotomacaco(i += n);
            if (i > 2 || i < 1) {i = 2}
        }

        function mudarFotomacaco(n) {
            if (n > 1){
                imagemMacaco.src = '_img/macaco-com-olho-fechado.png';
            } else {
                imagemMacaco.src = '_img/macaco.png';
            }
        }
    </script>
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

<?php mysqli_close($conecta); ?>
