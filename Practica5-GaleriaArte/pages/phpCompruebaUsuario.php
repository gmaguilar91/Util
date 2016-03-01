<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

$email = Request::post("email");
$password = Request::post("password");

$passEncriptada = encriptarSHA1($password);


$existe = $gestor->count('email like "' . $email . '"');
if ($existe == 1) {
    $sqlUsuario = $gestor->get($email);
    $sqlEmail = $sqlUsuario->getEmail();          
    $sqlPass = $sqlUsuario->getClave();           
    
    if ($passEncriptada === $sqlPass && $email === $sqlEmail) {
        $sqlEmail = $sqlUsuario->getEmail();
        $sqlAlias = $sqlUsuario->getAlias();
        $sqlPass = $sqlUsuario->getClave(); 
        $sqlFechaRegistro = $sqlUsuario->getFechaalta(); 
        $sqlAdmin = $sqlUsuario->getAdministrador();
        $sqlPersonal = $sqlUsuario->getPersonal();      
        $sqlActivo = $sqlUsuario->getActivo();      
        $sqlAvatar = $sqlUsuario->getAvatar(); 

        $usuario = new Usuario($sqlEmail, $sqlPass, $sqlAlias, $sqlFechaRegistro, $sqlActivo, $sqlAdmin, $sqlPersonal, $sqlAvatar);
        $sesion->setUser($usuario);
        $sesion->sendRedirect("phpControl.php");
    } else {
        $sesion->destroy();
        
        $sesion->sendRedirect("singin.php");
    }
} else {
    $sesion->destroy();
    $sesion->sendRedirect("singin.php");
}

function encriptarSHA1($cad) {
    return sha1($cad);
}