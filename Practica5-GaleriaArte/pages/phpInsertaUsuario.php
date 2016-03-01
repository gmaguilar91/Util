<?php

require '../clases/Google/autoload.php';
require '../clases/PHPMailer.php';
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
    $usuario = new Usuario($email, $passEncriptada, $alias);
    var_dump($usuario);
    $resultado = $gestor->insert($usuario);
    $claveActivacion = sha1($passEncriptada + Constants::SEMILLA);
    
    $correo = new Correo();
    
    $destino = $email;
    $asunto = "Activación de su cuenta";
    $mensaje = "Este es un correo de activación.
    
Diríjase a la siguiente URL para activar su cuenta: https://practica5-gmaguilar91.c9users.io/pages/phpActivate.php?activate=$claveActivacion&email=$email";
    
    $correo->setDestino($destino);
    $correo->setAsunto($asunto);
    $correo->setMensaje($mensaje);
    
    $correo->send();
    $sesion->destroy();
    $sesion->sendRedirect("sent.html");
} else {
    $sesion->destroy();
    $sesion->sendRedirect("userExist.html");
}
