<?php require_once('../conexao/conexao.php'); ?>
   
<?php
    /* Começo de teste de segurança */
    session_start();
    if (!isset($_SESSION["user_portal"]) ) { 
        header("location: ../login/index.php");
    }// Fim do teste de segurança

    
    if(isset($_SESSION["user_portal"]) ){
        //Fazendo a query do registro do usuario que está logado
        include("../_include/query_usuariologado.php");

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
    }
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
    include("../_include/query_sabores.php");
?>
<?php
    date_default_timezone_set("America/Sao_Paulo");
    
    //Criando um array associative para associar o value do tamanho com o nome

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $fk_usuario     = $_POST["fk_usuario"];
        $tamanho        = utf8_decode( $_POST["tamanho"] );
        $sabor1         = utf8_decode( $_POST["sabor1"] );
        $sabor2         = ( empty($_POST["sabor2"]) )? " " : $_POST["sabor2"];
        $sabor3         = ( empty($_POST["sabor3"]) )? " " : $_POST["sabor3"];
        $bebida         = ( empty($_POST["bebida"]) )? " " : $_POST["bebida"];
        $qnt_bebida     = ( empty($_POST["bebida"]) )? 0 : $_POST["qnt_bebida"];
        $observacao     = utf8_decode( $_POST["observacao"] );
        $forma_de_pagamento = utf8_decode( $_POST["forma_de_pagamento"] );
        $valor_total    = $_POST["valor"];
        $data_pedido    = $_POST["data_pedido"];
        $horario_pedido = $_POST["horario_pedido"];
        
        $q_inserirpedido = "INSERT INTO pedidos (fk_usuario,tamanho,sabor1,sabor2,sabor3,bebida,qnt_bebida,observacao,forma_de_pagamento,valor_total,data_pedido,horario_pedido) ";
        $q_inserirpedido .= "VALUES ($fk_usuario, '$tamanho', '$sabor1', '$sabor2', '$sabor3', '$bebida', $qnt_bebida, '$observacao', '$forma_de_pagamento', '$valor_total', '$data_pedido', '$horario_pedido') ";
        
        $inserirpedido = mysqli_query($conecta,$q_inserirpedido);
        if (!$inserirpedido) {
            die ("Erro ao inserir no banco de dados");
        } else {
           header("location: pedido-usuario/index.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Seu Site</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../_css/data-anime.css">
  <link href="_css/muestilo.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <style>
      .background-cinza{background-color:rgb(238, 238, 238)}
      
      .background-pizza{background-image: url('../_img/servindo-pizza.jpeg'); background-position: center bottom}
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
                
                <li class="nav-item ml-3 dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Bem vindo, <?php echo $nome ; ?> </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="pedido-usuario/index.php">Meus pedidos</a>
                        <a class="dropdown-item" href="pedido-usuario/logout.php">Sair</a>
                    </div>
                </li>
                
                <li class="nav-item"><a href="../index.php" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#" class="nav-link">COMO CHEGAR</a></li>
                <li class="nav-item"><a href="#" class="nav-link" data-toggle="modal" data-target="#modalcardapio">CARDÁPIO</a></li>
                <li class="nav-item"><a href="#" class="nav-link">EQUIPE</a></li>
            </ul>
        </div>
    </nav>
    
    <section class="secao-pedido background-pizza p-3">
        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="col-md-10 col-lg-7 pb-5 mt-5 bg-white rounded">
                    <form action="index.php" method="POST" class="mt-5" oninput="alterarValor()">
                        <h1 class=" display-4 text-center">Vamos começar</h1>
                        <p class="paragrafo text-center text-muted mb-5">Selecione o tamanho e os sabores desejados</p>
                        
                        <div class="form-group">
                            <select name="tamanho" id="tamanhoPizza" class="form-control mb-3" >
                                <option value="0"               data-valor-tamanho = "0"  >Escolha o tamanho...</option>
                                <option value="pequena"         data-valor-tamanho = "20" >Pequena</option>
                                <option value="media"           data-valor-tamanho = "30" >Média</option>
                                <option value="grande"          data-valor-tamanho = "45" >grande</option>
                                <option value="tamanho familia" data-valor-tamanho = "60" >Tamanho família</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="sabor1" class="form-control mb-3 sabor" id="sabor1" required">
                                <option disabled selected value="">Escolha o primeiro sabor...</option>
                                <?php while($linha = mysqli_fetch_assoc($primeirosabor) ) { ?>
                                <option data-saborespecial="<?php echo $linha["saborespecial"]; ?>"><?php echo utf8_encode( $linha["nomesabor"] ); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="sabor2" class="form-control mb-3 sabor" id="sabor2" disabled>
                                <option disabled selected value="">Escolha o segundo sabor...</option>
                                <?php while($linha = mysqli_fetch_assoc($segundosabor) ) { ?>
                                <option data-saborespecial="<?php echo $linha["saborespecial"]; ?>" ><?php echo utf8_encode( $linha["nomesabor"] ); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="sabor3" class="form-control mb-3 sabor" id="sabor3" disabled>
                                <option disabled selected>Escolha o segundo sabor...</option>
                                <?php while($linha = mysqli_fetch_assoc($terceirosabor) ) { ?>
                                <option data-saborespecial="" ><?php echo utf8_encode( $linha["nomesabor"] ); ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">

                                <select name="bebida" id="bebida" class="form-control mb-3 " oninput="alterarQuantidade()">
                                    <option value="0"               data-valor-bebida = "0" >Escolha o sua bebida...</option>
                                    <option value="Coca-Cola 2l"    data-valor-bebida = "10" >Coca-cola 2L</option>
                                    <option value="Guarana 2l"      data-valor-bebida = "10" >Guarana 2L</option>
                                    <option value="Coca-Cola 600ml" data-valor-bebida = "6" >Coca-cola 600ml </option>
                                    <option value="Coca-Cola lata"  data-valor-bebida = "5" >Coca-cola lata </option>
                                </select>
                            
                                <div class="input-group-prepend">
                                    <input type="number" name="qnt_bebida" min="0" max="10"  placeholder="Número de bebidas" id="qntBebida" class="form-control mb-3">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        </div>

                        <div class="form-group">
                            <textarea name="observacao" class="form-control" placeholder="Digite aqui alguma observação sobre seu pedido. Ex: Prefiro a pizza mais bem passada, obrigado e bom trabalho :)"></textarea>
                        </div>

                        <div class="dropdown">
                            <p class="muted dropdown-toggle" data-toggle="dropdown">Forma de pagamento</p>
                            <div class="dropdown-menu p-4">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="fpdinheiro" name="forma_de_pagamento" checked value="Dinheiro">
                                    <label for="fpdinheiro">Dinheiro</label>                             
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="fpcartaocredito" name="forma_de_pagamento" value="Cartão de crédito">
                                    <label for="fpcartaocredito">Cartão de crédito</label> 
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="fpcartaodebito" name="forma_de_pagamento" value="Cartão de débito">
                                    <label for="fpcartaodebito">cartão de débito</label> 
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="data_pedido" value="<?php echo date("y-m-d"); ?>">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="horario_pedido" value="<?php echo date("H:i:s"); ?>">
                        </div>

                        <div class="form-group mt-5 ">
                            <input type="hidden" name="fk_usuario" class="form-control" value="<?php echo $_SESSION["user_portal"] ; ?>">
                        </div>

                        <div class="form-group mt-5 ">

                            <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">R$</span>
                                </div>
                              
                              <input type="text" name="valor" class="form-control" id="inputValor" placeholder="Valor total R$" >
                              
                              <div class="input-group-prepend">
                                <button type="submit" class="btn btn-warning" id="botaoenviar" disabled> Pedir pizza &#62;&#62;</button>
                              </div>
                              
                           </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>

    <?php include("../_include/sessao_cardapio.php"); ?>

    <?php include("../_include/footer.php"); ?>

    <script>

        function alterarValor() {
            var sabor = document.getElementsByClassName('sabor'); // class de sabores
            var i;
            for ( i = 0; i < sabor.length; i++) {
                sabor[i].disabled = true;
            }

            //Selecionando e convertendo strings em tipo number
            let tamanhoPizza =  document.getElementById('tamanhoPizza').value;
            let bebida = document.getElementById('bebida').value;
            let qnt_bebida = document.getElementById('qntBebida').value;
            let sabor1 = document.getElementById('sabor1');// pega o select do 1° sabor
            let sabor2 = document.getElementById('sabor2');// pega o select do 2° sabor
            let sabor3 = document.getElementById('sabor3');// pega o select do 3° sabor

            let valor_tamanhopizza;;
            let valor_bebida = document.querySelectorAll('[data-valor-bebida]');;
            let valor_qnt_bebida = Number(qnt_bebida);
            let array_tamanhos = document.querySelectorAll('[data-valor-tamanho]');
            let valor_saborespecial1 = definirValorSaborEspecial(sabor1);
            let valor_saborespecial2 = definirValorSaborEspecial(sabor2);
            let valor_saborespecial3 = definirValorSaborEspecial(sabor3);

            // Vai atribuir valor do tamanho da pizza, conforme o value
            if (tamanhoPizza == "pequena") {
                valor_tamanhopizza = definirValorTamanho( array_tamanhos[1] );
                sabor[0].disabled = false;
                //document.getElementById('botaoenviar').disabled = false;
            } else if (tamanhoPizza == "media") {
                valor_tamanhopizza = definirValorTamanho( array_tamanhos[2] );
                sabor[0].disabled = false;
                sabor[1].disabled = false;
                //document.getElementById('botaoenviar').disabled = false;
            } else if (tamanhoPizza == "grande") {
                valor_tamanhopizza = definirValorTamanho( array_tamanhos[3] );
                sabor[0].disabled = false;
                sabor[1].disabled = false;
                sabor[2].disabled = false;
                
            } else if (tamanhoPizza == "tamanho familia") {
                valor_tamanhopizza = definirValorTamanho( array_tamanhos[4] );
                sabor[0].disabled = false;
                sabor[1].disabled = false;
                sabor[2].disabled = false;
                //document.getElementById('botaoenviar').disabled = false;
            } else {
                valor_tamanhopizza = 0;
                sabor[0].disabled = false;
                //document.getElementById('botaoenviar').disabled = false;
            }

            function definirValorTamanho ( componente ) {
                var option = componente.getAttribute("data-valor-tamanho");
                return Number( option ) ;
            }
    
            // Vai atribuir valor valor_bebida a bebida com o value de cada bebida
            if (bebida == "Coca-Cola 2l") {
                valor_bebida = 10.00;
            } else if (bebida == "Guarana 2l") {
                valor_bebida = 10.00;
            } else if (bebida == "Coca-Cola 600ml") {
                valor_bebida = 6.00;
            }  else if (bebida == "Coca-Cola lata") {
                valor_bebida = 5.00;
            } else if (bebida == "0") {
                valor_bebida = 0.00;
            }

            function definirValorBebida ( componente ) {
                var option = componente.getAttribute("data-valor-bebida");
                return Number( option ) ;
            }

            function definirValorSaborEspecial ( elemento ) {
                var atributo = Number(elemento[2].getAttribute("data-saborespecial") );
                var valor_atributo;

                for (i = 0; i < sabor1.length; i++) {
                    if (elemento[i].selected == true){// vai pegar somente o option selecionado
                        
                        if( atributo != 0){ // se o valor do saborespecial vir false ele não será adicionado
                            if (tamanhoPizza == "pequena") {
                                valor_atributo = 2 ;
                            } else if (tamanhoPizza == "media") {
                                valor_atributo = 3 ;
                            } else if (tamanhoPizza == "grande") {
                                valor_atributo = 4 ;
                            } else if (tamanhoPizza == "tamanho familia") {
                                valor_atributo = 5 ;
                            }
                        } else {
                            valor_atributo = 0;
                        }
                    } 
                }
                return valor_atributo; // Ira retornar o valor do sabor especial
            }
            //Liberar botão
            if (tamanhoPizza == "pequena" || tamanhoPizza == "media" || tamanhoPizza == "grande" || tamanhoPizza == "tamanho familia") {
                if (sabor1.value.length > 1) {
                    document.getElementById('botaoenviar').disabled = false;
                }    
            }


            let tot = valor_tamanhopizza + (valor_bebida * valor_qnt_bebida ) + valor_saborespecial1 + valor_saborespecial2 + valor_saborespecial3;
            // Exibir valor na tela
            document.getElementById('inputValor').value =  tot ;
            
        }

        function alterarQuantidade() {
            /* Pegar o input de quantidade de bebida e colocar o valor 1 */
            let qnt_bebida = document.getElementById('qntBebida');
            qnt_bebida.value = "1";
            
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

<?php
    /*
    mysqli_free_result($primeirosabor);
    mysqli_free_result($segundosabor);
    mysqli_free_result($terceirosabor);
    */
    mysqli_close($conecta);
?>
