<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

$user = $gestor->get(Request::post("pkEmail"));

$aliasNuevo = Request::post("alias");
$emailNuevo = Request::post("email");
$passNueva = Request::post("contrasena");
$fechaalta = $user->getFechaalta();
$admin = Request::post("admin");
$personal = Request::post("personal");
$activo = Request::post("activo");
$avatar = Request::post("avatarNuevo");
$pkEmail = $user->getEmail();

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

if (!isset($passNueva)) {
    $passEncriptada = $user->getClave();
} else {
    $passEncriptada = sha1($passNueva);
}

$nombre_archivo = $_FILES["avatarNuevo"]["name"]; //Coger avatar de $_FILES

$destino = "../images/";

if (!$nombre_archivo == "") {
    echo $ruta_nombre_archivo = $destino . $nombre_archivo;
} else {
    $avatarUsuario = $user->getAvatar();
    $ruta_nombre_archivo = $avatarUsuario;
}

$subir = new FileUpload("avatarNuevo"); // Crear objeto FileUpload
$subir->setNombre($nombre_archivo); // Seteamos el nombre del archivo
$subir->setDestino($destino); // Seteamos el directorio del archivo

$subir->setTamanio(70000000); // Seteamos el tamaÃ±o del archivo (para grandes, lo hago pero se puede borrar)

if ($subir->upload()) {
    //echo "Archivo subido";
} else {
    //echo 'Archivo no subido';
}

$usuario = new Usuario($emailNuevo, $passEncriptada, $aliasNuevo, $fechaalta, $activo, $admin, $personal, $ruta_nombre_archivo);

$gestor->setForAdmin($usuario, $pkEmail);

$sesion->sendRedirect("tablePersonal.php");

