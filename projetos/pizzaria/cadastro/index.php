<?php require_once("../conexao/conexao.php"); ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome       = utf8_decode( ucwords($_POST["nome"]) );
        $telefone   = $_POST["telefone"];
        $sexo       = $_POST["sexo"];
        $endereco   = utf8_decode( $_POST["endereco"] );
        $bairro     = utf8_decode( ucwords($_POST["bairro"]) );
        $email      = strtolower( $_POST["email"] );
        $senha      = utf8_decode( $_POST["senha"] );

        $q_inserir = "INSERT INTO usuarios (nome,telefone,sexo,endereco,bairro,email,senha) VALUES ";
        $q_inserir .= "('$nome','$telefone','$sexo','$endereco','$bairro','$email','$senha')";
        $inserir = mysqli_query($conecta,$q_inserir);
        if (!$inserir) {
            die("Houve um erro ao inserir no banco de dados");
        }
        header('location:../login/index.php');
        
    }

    $q_bairros = "SELECT * FROM bairros ";
    $bairros   = mysqli_query($conecta, $q_bairros);
    if (!$bairros) {
        die("Erro na consulta ao banco de dados");
    }

    include("../_include/query_sabores.php"); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Seu Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../_css/data-anime.css">
  <link rel="stylesheet" href="../_css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
      .cadastro{background: url('../_img/servindo-pizza.jpeg') center bottom}
      
      .background-cinza{background-color:rgb(238, 238, 238)}

      /*Informação de letra na senha*/
      
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
                <li class="nav-item"><a href="../index.php" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalcardapio">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>

    <section class="cadastro pl-2 pr-2 pt-5 pb-5">
        <div class="container pb-5">
            <div class="row justify-content-md-center">
                <div class="col-md-7 col-lg-7 pb-5 mt-5 bg-white rounded">
                    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" class="">

                        <h1 class="mt-5 display-4 text-center">Cadastro</h1>
                        <p class="paragrafo text-center text-muted mb-3">Faça seu cadastro e peça sua pizza ;)</p>
                        <img src="../_img/genero.png" id="imagemFormulario" class="d-block m-auto" style="border-radius: 50%">
                        <div class="form-group mb-5">
                            <input type="text" class="form-control mb-4" name="nome" maxlength="30" placeholder="Digite aqui seu nome" required>
                            <input type="text" class="form-control mb-3" name="telefone" maxlength="30" placeholder="Digite aqui seu telefone" required>
                            <select class="form-control" id="sexo" name="sexo" oninput="mudarFoto()">
                                <option disabled selected>Selecione seu genêro</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                                <option value="O">Outros</option>
                            </select>
                        </div>

                        <div class="form-group mb-5">
                            <input type="text" name="endereco" class="form-control mb-3" placeholder="Digite aqui seu endereço. Ex: Rua João, n°987 casa verde" required>
                            <select class="form-control" name="bairro" required>
                                <option value="..." disabled >Selecione o bairro</option>
                                <?php while($linha = mysqli_fetch_assoc($bairros) ) { ?>
                                <option value="<?php echo utf8_encode( $linha["nome"] ); ?>"><?php echo utf8_encode( $linha["nome"] ); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group mb-5" oninput="alterarBotao()">
                            <input type="email" name="email" class="form-control mb-3" maxlength="255" placeholder="Digite aqui seu E-mail" required>
                            <span id="mensagemInformacao" class="text-muted"><i>*A senha necessita no minimo uma letra</i></span>
                            <input type="password" id="senha" name="senha" minlength="8" maxlength="50" class="form-control mb-3" placeholder="Digite aqui sua senha" required>
                            <input type="password" id="confsenha" maxlength="255"  class="form-control mb-3" placeholder="Confirme aqui sua senha" required>
                        </div>
                        <button type="submit" name="enviar" id="botaoDeEnviar" class="btn btn-warning" disabled>Me cadastrar</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <?php include("../_include/sessao_cardapio.php"); ?>

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
    <!-- Mudar imagem conforme o sexo -->
    <script src="../_js/mudarImagem.js"></script>
    
    <!-- Alterar botão -->
    <script>        
        function alterarBotao() {
            let botao = document.getElementById('botaoDeEnviar'); // buttom of submit
            let senha = document.getElementById('senha').value ; // get the length of password
            let confsenha = document.getElementById('confsenha').value; // get the length of confirmation password

            //Testando se a senha e a conf senha são iguais
            if (senha == confsenha){
                let alfabeto = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","P","q","r","s","t","u","v","w","x","y","z"]; // a array with all letter of the alphabet

                // Esse for consulta todas letras do alfabeto uma por uma
                for (let i = 0 ; i < alfabeto.length; i++ ) { 
                    
                    //verifica se o input de senha possui alguma letra do alfabeto
                    if (senha.indexOf( alfabeto[i] ) > -1 ) {
                        botao.disabled = false; // Se possui o botão submit tera valor false, ou seja será liberado
                        document.getElementById('mensagemInformacao').innerHTML = "";
                    } else {
                        
                    }
                } 
                
            } else{
                botao.disabled = true;
                //document.getElementById('mensagemInformacao').innerHTML = "As senha não coincidem";
            }
        }
    </script>
</body>
</html>

<?php
    mysqli_close($conecta);
?>

