window.onload = inicio;

function inicio(){
    setInterval(cambiar,2000);
    
}

function cambiar(){
    var lista = document.getElementById("lista");
    var palabras = new Array();
    palabras[0] = "beautiful";
    palabras[1] = "awesome";
    palabras[2] = "comfortable";
    palabras[3] = "cozy";
    
    var num = Math.floor(Math.random()*4);
    var anterior = 4;
    
    while(num === anterior){
        num = Math.floor(Math.random()*4);
    }
    anterior = num;
    lista.innerText =  palabras[num];
}