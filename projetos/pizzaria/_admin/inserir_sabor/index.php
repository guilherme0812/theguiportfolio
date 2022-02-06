<?php require_once("../../conexao/conexao.php"); ?>
<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_sabor = utf8_decode( $_POST["nomesabor"] );
        $ingredientes = utf8_decode( $_POST["ingredientes"] );
        $sabor_especial = $_POST["saborespecial"];

        $q_inserir_primeirosabor = "INSERT INTO sabores (nomesabor,ingredientes,saborespecial) ";
        $q_inserir_primeirosabor .= "VALUES ('$nome_sabor','$ingredientes',$sabor_especial)";
        $inserir_primeirosabor = mysqli_query($conecta,$q_inserir_primeirosabor);
        
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../_css/data-anime.css">
  <link rel="stylesheet" href="../../_css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
                <a href="../index.php"><button class="btn btn-warning">Fazer mais um pedido</button></a> 
                <li class="nav-item ml-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Bem vindo, <?php// echo $nome ; ?> </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php">Meus pedidos</a>
                        <a class="dropdown-item" href="../login/logout.php">Sair</a>
                    </div>
                </li>
                <li class="nav-item"><a href="../index.php" class="nav-link">PAINEL</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>

    <header class=" p-5 bg-light">
        <h1 class="text-center mt-5">Adicionar novo sabor</h1>
        <h3 class="text-center text-muted">Preencha o formulário e adicione um novo sabor</h3>
    </header>
    <section>
        <div class="container p-5">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="form-group">
                    <label>Nome do novo sabor</label>
                    <input type="text" name="nomesabor" id="nomesabor" class="form-control" placeholder="Digite o nome" min="5" max="20" required oninput="mudarNome()">
                </div>
                <div class="form-group">
                    <label>Ingrediêntes</label>
                    <input type="text" name="ingredientes" class="form-control" placeholder="Digite os ingrediêntes" min="20" max="300" required>
                </div>
                <h5>Sabor especial: </h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="false" name="saborespecial" id="sim">
                    <label class="form-check-label" for="sim">
                        Não
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="true" name="saborespecial" id="nao">
                    <label class="form-check-label" for="nao">
                        Sim
                    </label>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Enviar novo sabor</button>
            </form>
        </div>
        
    </section>
    <script src="../../_js/mudarNomeSabor.js"></script>
    <script src="../../_js/data-anime.js"></script>
</body>
</html>

<?php mysqli_close($conecta); ?>
