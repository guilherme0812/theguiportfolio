<?php
    $usuario = $_SESSION["user_portal"];

    $q_usuariologado = "SELECT * FROM usuarios WHERE usuarioID = {$usuario} ";
        
    $usuariologado = mysqli_query($conecta, $q_usuariologado);
    if (!$usuariologado) {
        die ("Erro na consulta ao banco de dados");
    }

    $usuariologado = mysqli_fetch_assoc($usuariologado);
?>