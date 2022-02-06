<?php 
    //Abrir coxeção
    
    $serividor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "pizzaria";
    $conecta = mysqli_connect($serividor,$usuario,$senha,$banco);

    //Passp 2 - Testar conexão
    
    if(mysqli_connect_errno()) {
        die("Conexão falhou: " . mysql_connect_errno());
    }
?>