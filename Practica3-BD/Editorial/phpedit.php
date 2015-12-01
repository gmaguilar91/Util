<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageEditorial($bd);
$pkEditorial = Request::post("pkidEditorial");
$idEditorial = Request::post("idEditorial");
$nombre = Request::post("nombre");
$pais = Request::post("pais");


$editorial = new Editorial($idEditorial, $nombre, $pais);
$r = $gestor->set($editorial, $pkEditorial);

$bd->close();
echo "<br/>";
header("Location:editbooks.php?op=edit&r=$r");