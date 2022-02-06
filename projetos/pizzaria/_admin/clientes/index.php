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

    
    if(isset($_SESSION["user_admin"]) ){
        $q_usuarios = "SELECT * FROM usuarios LIMIT 200 ";
        $usuarios   = mysqli_query($conecta, $q_usuarios);
        if (!$usuarios) {
            die("Erro na consulta ao banco de dados");
        }
        
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
    
   <section class="pt-5 pb-5 background-paisagem">
    
        <div class="container pt-5">
        
            <div class="table-responsive">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th class="d-none d-md-block">#</th>
                            <th>NOME</th>
                            <th>TELEFONE</th>
                            <th>FUNÇÃO</th>
                            <th>EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                            <?php while( $linha = $array_usuarios = mysqli_fetch_assoc($usuarios) ) { ?>
                            <tr>
                                <td class="d-none d-md-block"><?php echo $linha["usuarioID"]; ?></td>
                                <td><?php echo $linha["nome"]; ?></td>
                                <td><?php echo $linha["telefone"]; ?></td>
                                <td><a href="cliente-detalhe.php?usuario=<?php echo $linha["usuarioID"]; ?>">Alterar</a></td>
                                <td><a href="excluir.php?usuario=<?php echo $linha["usuarioID"]; ?>"  class="text-danger">Deletar</a></td>
                            </tr>
                            <?php } ?>

                        </form>                    
                    </tbody>

                </table>
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
