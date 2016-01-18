<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);

$email = Request::post("email");
$password = Request::post("contrasena");
$strPos = strpos($email, "@");
$alias = substr($email, 0, $strPos);

$passEncriptada = sha1($password);

$sqlResultado = $gestor->count("alias like '" . $alias . "'");

$sesion = new Session();

if ($sqlResultado[0] == 0) {
    $sesion->set("AliasUsuario", $alias);
    $usuario = new Usuario($email, $passEncriptada, $alias);

    $gestor->insert($usuario);
    //$sesion->sendRedirect("envioCorreo.php");
    echo "<br/> Usuario introducido en la base de datos satisfactoriamente.";
} else {
    echo "<br/>Usuario ya registrado.";
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
}
