var imagem = document.getElementById('imagemFormulario');
    function mudarFoto () {
        var sexo = document.getElementById('sexo').value ;
        switch (sexo) {
            case 'M':
                imagem.src = "../_img/homem.png";
                break;
            case 'F':
                imagem.src = "../_img/mulher.png";
                break;
            case 'O':
                imagem.src = "../_img/o.png";
                break;    
        }
    }