<?php

require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageUsuario($bd);
$sesion = new Session();

/*
 * ComprobaciÃ³n del tipo de usuario que sea para llevarlo a su pÃ¡gina
 */

$usuario = $sesion->getUser();
echo $usuario->getAlias();

$admin = $usuario->getAdministrador();
$personal = $usuario->getPersonal();
$activo = $usuario->getActivo();

if ($admin == 1 && $personal == 0 && $activo == 1) {
    $sesion->sendRedirect("../admin/profileAdmin.php");
} else if ($admin == 0 && $personal == 1 && $activo == 1) {
    $sesion->sendRedirect("../personal/profilePersonal.php");
} else if ($admin == 0 && $personal == 0 && $activo == 1) {
    $sesion->sendRedirect("../user/profileUser.php");
} else if ($activo == 0) {
    $sesion->sendRedirect("noActivo.php");
}