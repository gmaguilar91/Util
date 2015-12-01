<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutores($bd);
$pkAutores = Request::post("pkidAutores");
$idAutores = Request::post("idAutores");
$nombre = Request::post("nombre");
$apellidos = Request::post("apellidos");
$nacionalidad = Request::post("nacionalidad");

$autor = new Autores($idAutores, $nombre, $apellidos, $nacionalidad);
$r = $gestor->set($autor, $pkAutores);

$bd->close();
echo "<br/>";
header("Location:writers.php?op=edit&r=$r");