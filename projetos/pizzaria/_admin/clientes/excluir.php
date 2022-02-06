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
    /* excluir usuario */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $usuarioID = $_POST["usuarioID"];
        
        $q_excluirusuario = "DELETE FROM usuarios WHERE usuarioID = '{$usuarioID}' ";
        
        $excluirusuario = mysqli_query($conecta, $q_excluirusuario);
        if (!$excluirusuario) {
            die("Erro no registro usuario");
        } else {
            header("location: ../index.php");
        }
        
    }
?>
<?php
    if (isset($_GET["usuario"])) {
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
    <!--Navegação 
    
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
    -->
   <section class="pl-2 pr-2 pt-5 pb-5 background-paisagem">
    
    <div class="container pt-5 pb-5">
        <div class="row justify-content-md-center">
            <div class="col-md-7 col-lg-7 pt-5 pb-5 mt-5 bg-white rounded">
                <h2>Excluir usuários</h2>

                <form action="excluir.php" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome do usuário: <?php echo $array_usuario["nome"] ?></label>
                            <input type="hidden" name="nome" value="<?php echo $array_usuario["nome"] ?>" class="form-control" >
                        </div>
                        
                        <div class="form-group col-9 col-md-6">
                            <label>Telefone: <?php echo $array_usuario["telefone"] ?></label> 
                            <input type="hidden" name="telefone" value="<?php echo $array_usuario["telefone"] ?>" class="form-control" >
                        </div>

                        <div class="form-group col-6">
                            <label>Enderêço: <?php echo utf8_encode( $array_usuario["endereco"] ); ?></label>
                            <input type="hidden" name="endereco" value="<?php echo $array_usuario["endereco"] ?>" class="form-control" >
                        </div>

                        <div class="form-group col-6">
                        <label>Bairro: <?php echo utf8_encode( $array_usuario["bairro"] ); ?></label>
                            <input type="hidden" name="bairro" value="<?php echo utf8_encode( $array_usuario["bairro"] ); ?>"> 
                        </div>

                        <div class="form-group col-6">
                            <input type="hidden" name="usuarioID" value="<?php echo utf8_encode( $array_usuario["usuarioID"] ); ?>">
                        </div> 
                    </div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalexclusao">Confirmar exclusão</button>    
                    <!-- Modal -->
                    <div class="modal fade" id="modalexclusao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Você deseja realmente excluir essa conta de usuário ? Essas alterarações não poderão ser revertidas.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Excluir</button>
                                </div>
                            </div>
                        </div>
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
