<?php
require 'clases/AutoCarga.php';
$control = new Controlador();
$sesion = new Session();

if($sesion->isLogged()){
    $control->metodo0();
} else {
    $control->handle();
}
