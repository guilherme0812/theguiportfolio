<?php 
    /* FAZENDO QUERI DE SABPRES*/
    $q_sabores = "SELECT * FROM sabores ";
    
    $sabores   = mysqli_query($conecta, $q_sabores);
    if (!$sabores) {
        die("Erro ao consultar os sabores");
    }
?>   