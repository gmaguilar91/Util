<?php

require 'clases/AutoCarga.php';
$sesion = new Session();

$numSocial = Request::post("id_us");
$dia = Request::post("dia");
$mes = Request::post("mes");
$anio = Request::post("anio");
$dni = Request::post("dni");

$sesion->set("numSocial", $numSocial);
$sesion->set("diaNacimiento", $dia);
$sesion->set("mesNacimiento", $mes);
$sesion->set("anioNacimiento", $anio);
$sesion->set("dni", $dni);

$listaArchivos = FileUploadMultiple::transformar(FileUploadMultiple::trans($_FILES));
$longitud = sizeof($listaArchivos);
$correctas = 0;
$fallos = 0;
$sesion->set("numArchivos", $longitud);
$sesion->set("correctas", $correctas);
$sesion->set("fallos", $fallos);


for ($i = 0; $i < $longitud; $i++) {
    $archivo = new subirMuchos($listaArchivos, $i);
    $archivo->setDestino("../../userSAS/" . $sesion->get("numSocial"));
    $archivo->setNombre($sesion->get("numSocial") . "_" . $i);
    $subir = $archivo->subirAcarpeta($sesion->get("numSocial"));
    if ($subir) {
        $correctas++;
        $sesion->set("correctas", $correctas);
    } else {
        $fallos++;
        $sesion->set("fallos", $fallos);
    }
}
$sesion->set("ruta", $archivo->getDestino());

$sesion->sendRedirect("sas_subir.php");