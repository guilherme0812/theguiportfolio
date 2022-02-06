function mudarNome() {
    //Pegar valor do nome do sabor e trasformar em minuscula
    var nomesabor = document.getElementById('nomesabor').value;
    var primeiraletra = nomesabor.slice(0,1).toUpperCase();
    var restnome = nomesabor.slice(1,nomesabor.length);

    document.getElementById('nomesabor').value = primeiraletra + restnome;
}
