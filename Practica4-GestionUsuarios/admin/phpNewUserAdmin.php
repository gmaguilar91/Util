<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

/* * ** Recogida de datos del formulario *** */

$email = Request::post("email");
$pass = Request::post("password");

$strPos = strpos($email, "@");
$alias = substr($email, 0, $strPos);

$admin = Request::post("admin");
$personal = Request::post("personal");
$activo = Request::post("activo");


/*
 * Comprobacion de los datos pasados en los checkbox 
 */
 
if ($admin === null) {
    $admin = 0;
} else if ($admin === "on") {
    $admin = 1;
}

if ($personal === null) {
    $personal = 0;
} else if ($personal === "on") {
    $personal = 1;
}

if ($activo === null) {
    $activo = 0;
} else if ($activo === "on") {
    $activo = 1;
}


$passEncriptada = sha1($pass);

/* * ** InsercciÃ³n del usuario en la base de datos *** */
//$nombre_archivo = $_FILES["avatar"]["name"]; //Coger avatar de $_FILES
//
//$destino = "../dist/img/";
//
//
//echo $ruta_nombre_archivo = $destino . $nombre_archivo;
//
//
//$subir = new FileUpload("avatar"); // Crear objeto FileUpload
//$subir->setNombre($nombre_archivo); // Seteamos el nombre del archivo
//$subir->setDestino($destino); // Seteamos el directorio del archivo

//$subir->setTamanio(70000000); // Seteamos el tamaÃ±o del archivo (para grandes, lo hago pero se puede borrar)
/*
  $img_portada = $subir->getDestino() . "" . $nombre_archivo;
  echo "img portada: " . $img_portada . "<br/>";
 */
/*
 * Hacemos la subida del archivo 
 */
//if ($subir->upload()) {
//    echo "Archivo subido";
//} else {
//    echo 'Archivo no subido';
//}

$sqlResultado = $gestor->count("alias like '" . $alias . "'");

if ($sqlResultado[0] == 0) {
    $usuario = new Usuario($email, $passEncriptada, $alias, "", $admin, $personal, $activo);

    $gestor->insert($usuario);
    $sesion->sendRedirect("tableAdmin.php");
    echo "<br/> Usuario introducido en la base de datos satisfactoriamente.";
} else {
    echo "<br/>Usuario ya registrado.";
    //$sesion->sendRedirect("tableAdmin.php"); Esto hay que arreglarlo porque no redirige bien, culpa del c9 me temo
    /* $sesion->destroy();
      $sesion->sendRedirect("../index.php"); */
}
