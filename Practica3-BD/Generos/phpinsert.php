<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageGeneros($bd);

$idGeneros = Request::post("idGeneros");

$genero = new Generos($idGeneros);

$r = $gestor->insert($genero);
$bd->close();
header("Location:genders.php?op=insert&r=$r");