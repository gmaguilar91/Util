<?php

/*
 * En este archivo se procede al inicio de sesión en la base de datos con un usuario
 * que se encuentre en la misma, se comprueba quÃ© permisos tiene y en funciÃ³n de eso,
 * lo lleva a su pÃ¡gina de administración correspondiente, o a la pÃ¡gina de error.
 */

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

/* * * Recogida de datos del formulario * * */

$email = Request::post("email");
$password = Request::post("password");
/* * * EncriptaciÃ³n de la contraseÃ±a * * */

$passEncriptada = encriptarSHA1($password);

/* * * Consulta a la base de datos y almacenamiento de los datos en variables * * */

/*
 * Comprueba que el usuario existe en la base de datos, si existe recoge los datos devueltos,
 * si no existe, lo devuelve a la pÃ¡gina del login, posteriormente serÃ­a interesante aÃ±adir
 * mensajes en el login si la contraseÃ±a no es correcta, si el usuario no existe...
 */
$existe = $gestor->count('email like "' . $email . '"');

if ($existe == 1) {
    $sqlUsuario = $gestor->get($email);
    $sqlEmail = $sqlUsuario->getEmail();            // Alias
    $sqlPass = $sqlUsuario->getClave();             // Clave
    if ($passEncriptada === $sqlPass && $email === $sqlEmail) {
        $sqlEmail = $sqlUsuario->getEmail();            // Email
        $sqlAlias = $sqlUsuario->getAlias();            // Alias
        $sqlPass = $sqlUsuario->getClave();             // Clave
        $sqlFechaRegistro = $sqlUsuario->getFechaalta(); // Fecha alta
        $sqlAdmin = $sqlUsuario->getAdministrador();    // Admin?
        $sqlPersonal = $sqlUsuario->getPersonal();      // Personal?
        $sqlActivo = $sqlUsuario->getActivo();          // Activo?
        $sqlAvatar = $sqlUsuario->getAvatar();          // Avatar

        $usuario = new Usuario($sqlEmail, $sqlPass, $sqlAlias, $sqlFechaRegistro,$sqlActivo, $sqlAdmin, $sqlPersonal, $sqlAvatar);
        $sesion->setUser($usuario);
        $sesion->sendRedirect("phpControl.php");
        //$sesion->sendRedirect("profile.php");
    } else {
       // $sesion->destroy();
        
        $sesion->sendRedirect("../index.php");
    }
} else {
    $sesion->destroy();
    //$sesion->sendRedirect("../index.php");
}

function encriptarSHA1($cad) {
    return sha1($cad);
}