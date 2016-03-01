window.onload = inicio;

function inicio() {
    var pass1 = document.getElementById("contrasena");
    var pass2 = document.getElementById("validaContrasena");
    pass1.addEventListener("focusout", estaVacio);
    pass1.addEventListener("change", estaVacio);
    pass2.addEventListener("focusout", estaVacio);
    pass2.addEventListener("change", estaVacio);

    pass1.addEventListener("change", comprobarPassword);
    pass2.addEventListener("change", comprobarPassword);
    pass1.addEventListener("focusout", comprobarPassword);
    pass2.addEventListener("focusout", comprobarPassword);
}

function estaVacio(e) {
    if (e.target.value === "") {
        e.target.nextElementSibling.innerText = "Required";
    } else {
        e.target.nextElementSibling.innerText = "";
    }
}

function comprobarPassword(e) {
    var pass1 = document.getElementById("contrasena");
    var pass2 = document.getElementById("validaContrasena");
    if (pass1.value !== pass2.value) {
        e.target.nextElementSibling.innerText = "No coinciden las contraseñas";
        e.preventDefault();
    }
}