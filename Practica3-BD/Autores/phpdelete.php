<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutores($bd);
$idAutores = Request::get("idAutores");
$r = $gestor->delete($idAutores);

header("Location:writers.php?op=delete&r=$r");
