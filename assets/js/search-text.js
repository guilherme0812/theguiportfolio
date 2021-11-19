let barra = document.getElementById('barra-piscante')

function piscarBarra () {
    barra.classList.toggle("barra-piscante")
}
setInterval(() => {
    piscarBarra()
}, 500);