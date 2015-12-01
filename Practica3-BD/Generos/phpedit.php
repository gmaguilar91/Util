<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageGeneros($bd);
$idGeneros = Request::post("idGeneros");
$pkidGeneros = Request::post("pkidGeneros");

$genero = new Generos($idGeneros);
$r = $gestor->set($genero, $pkidGeneros);

$bd->close();
echo "<br/>";
header("Location:genders.php?op=edit&r=$r");