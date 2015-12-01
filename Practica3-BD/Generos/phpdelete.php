<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageGeneros($bd);
$genero = Request::get("idGeneros");
$r = $gestor->delete($genero);

header("Location:genders.php?op=delete&r=$r");
