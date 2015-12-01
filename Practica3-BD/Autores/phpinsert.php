<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutores($bd);

$idAutores = Request::post("idAutores");
$nombre = Request::post("nombre");
$apellidos = Request::post("apellidos");
$nacionalidad = Request::post("nacionalidad");

$editorial = new Autores($idAutores,$nombre, $apellidos, $nacionalidad);

$r = $gestor->insert($editorial);

$bd->close();
echo "<br/>";
header("Location:writers.php?op=insert&r=$r");