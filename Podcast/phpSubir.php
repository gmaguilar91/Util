<?php

require 'clases/AutoCarga.php';

$categoria = Request::post("categoria");
$sesion = new Session();
$usuario = $sesion->getUser();
$archivo = new SubirArchivo("archivos",$categoria);
$sesion->set("categoria", $categoria);

$archivo->setNombre($usuario . "_" . $categoria);

$subir = $archivo->subirAcarpeta($usuario);
$sesion->sendRedirect("subirFile.php");
