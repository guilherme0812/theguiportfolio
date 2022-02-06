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
    /* verificando se existe algum código de usuaario no método GET*/
    

    $q_bairros = "SELECT * FROM bairros ";
    $bairros   = mysqli_query($conecta, $q_bairros);
    if (!$bairros) {
        die("Erro na consulta ao banco de dados");
    }
    //QUERY DE SABORES PARA O MODAL
    include_once("../../_include/query_sabores.php"); 
?>
<?php
    /* Query de usuario */
    if (!isset($_GET["usuario"]) ) { 
        header("location: ../index.php");
    }

    $q_usuarios = "SELECT * FROM usuarios WHERE usuarioID = '{$_GET['usuario']}' ";

    $usuarios   = mysqli_query($conecta, $q_usuarios);
    if (!$usuarios) {
        die("Erro na consulta ao banco de dados");
    }

    $array_usuario = mysqli_fetch_assoc($usuarios);

    function marcarSelect ($sexo) {// Essa função faz que o genero do usuario venha selecionado no formulario
        global $array_usuario;
        
        
        if ($sexo == $array_usuario["sexo"] ) {
            return "selected";
        }    
    }

?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome       = $_POST["nome"];
        $telefone   = $_POST["telefone"];
        $sexo       = $_POST["sexo"];
        $endereco   = $_POST["endereco"];
        $bairro     = $_POST["bairro"];
        $email      = $_POST["email"];
        $senha      = $_POST["senha"];
        $usuarioID  = $_POST["usuarioID"];

        $q_alterarusuario = "UPDATE usuarios SET nome = '{$nome}', telefone = '{$telefone}', sexo = '{$sexo}', endereco = '{$endereco}', bairro = '{$bairro}', email = '{$email}', senha = '{$senha}' ";
        $q_alterarusuario .= "WHERE usuarioID = '{$usuarioID}' ";

        $alterarusuario = mysqli_query($conecta, $q_alterarusuario);
        if (!$alterarusuario) {
            die("Erro ao aterar sabor");
        }
    }
?>
<?php ?>
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
      .background-paisagem{background-image: url('../../_img/paisagem.jpeg'); background-position: center bottom}
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
    
   <section class="pl-2 pr-2 pt-5 pb-5 background-paisagem">
    
    <div class="container pt-5 pb-5">
        <div class="row justify-content-md-center">
            <div class="col-md-7 col-lg-7 pt-5 pb-5 mt-5 bg-white rounded">
                <h2>Alterar informações de usuários</h2>
                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do usuário</label>
                            <input type="text" name="nome" value="<?php echo $array_usuario["nome"] ?>" class="form-control">
                        </div>
                        
                        <div class="form-group col-9 col-md-4">
                            <label>Telefone</label>
                            <input type="tel" name="telefone" value="<?php echo $array_usuario["telefone"] ?>" class="form-control">
                        </div>

                        <div class="form-group col-3 col-md-2">
                            <label>Genêro</label>
                            <select name="sexo" class="form-control">
                                <option value="O" <?php echo marcarSelect("O"); ?> ><?php echo "Outros";  ?></option>
                                <option value="M" <?php echo marcarSelect("M"); ?> ><?php echo "Masculino"; ?></option>
                                <option value="F" <?php echo marcarSelect("F"); ?> ><?php echo "Feminino"; ?></option>
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label>Adicione o enderêço:</label>
                            <input type="text" name="endereco" value="<?php echo $array_usuario["endereco"] ?>" class="form-control">
                        </div>

                        <div class="form-group col-6">
                        <label>Selecione o bairro:</label>
                            <select class="form-control" name="bairro">
                                <?php while($linha = mysqli_fetch_assoc($bairros) ) { ?>
                                    <option value="<?php echo utf8_encode( $linha["nome"] ); ?>"><?php echo utf8_encode( $linha["nome"] ); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Altere o email:</label>
                            <input type="text" name="email" value="<?php echo $array_usuario["email"] ?>" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Alterar senha:</label>
                            <input type="text" name="senha" value="<?php echo $array_usuario["senha"] ?>" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="usuarioID" value="<?php echo $array_usuario["usuarioID"] ?>" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-outline-warning btn-block mt-3">Alterar</button>
                    </div>    
                </form>
            </div>           
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
