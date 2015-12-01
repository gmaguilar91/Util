<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageEditorial($bd);

$idEditorial = Request::post("idEditorial");
$nombre = Request::post("nombre");
$pais = Request::post("pais");

$editorial = new Editorial($idEditorial,$nombre, $pais);

$r = $gestor->insert($editorial);

$bd->close();
echo "<br/>";
header("Location:editbooks.php?op=insert&r=$r");