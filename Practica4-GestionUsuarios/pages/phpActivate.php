<?php
require_once '../clases/AutoCarga.php';

$sesion = new Session();
$bd = new DataBase();
$gestor = new ManageUsuario($bd);

$clave = Request::get("activate");
$email = Request::get("email");

$claveConfirmacion = $clave;

$strPos = strpos($email, "@"); 
$alias = substr($email, 0, $strPos); 

$user = $gestor->get($email);

$activo = $user->getActivo(); 

$passUser = $user->getClave();

$claveGenerada = sha1($passUser + Constants::SEMILLA);

if ($claveGenerada === $claveConfirmacion && $activo == 0) {
    $user->setActivo(1);
    $gestor->setForAdmin($user, $email);
    $sesion->destroy();
    $sesion->sendRedirect("activate.html");
} else {
    $sesion->destroy();
    $sesion->sendRedirect("../index.php");
}