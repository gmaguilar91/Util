<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageImagen($bd);
$sesion = new Session();

$email = Request::post("pkEmail");
$categoria = Request::post("category");

if ($categoria === "Portrait") {
    $categoria = "portraits";
} else if ($categoria === "Landscape") {
    $categoria = "landscapes";
} else if ($categoria === "Animal") {
    $categoria = "animals";
}

$ultimaPagina = Request::post("lastPage");

$nombre_archivo = $_FILES["imgGaleria"]["name"]; 

$destino = "../images/gallery/";

if ($nombre_archivo == null) {
    $nombre_archivo = "imgNotFound.jpg";
}

$ruta_nombre_archivo = $destino . $nombre_archivo;

$subir = new FileUpload("imgGaleria"); 
$subir->setNombre($nombre_archivo); 
$subir->setDestino($destino); 

$subir->setTamanio(70000000);

if ($subir->upload()) {
    echo "Archivo subido";
} else {
    echo 'Archivo no subido';
}

echo $sqlResultado = $gestor->count("email like '" . $email . "'");

    $imagen = new Imagenes("",$email, $categoria, $ruta_nombre_archivo);
    $gestor->insert($imagen);
    $sesion->sendRedirect("../".$ultimaPagina);
