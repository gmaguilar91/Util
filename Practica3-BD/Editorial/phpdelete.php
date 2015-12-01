<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageEditorial($bd);
$idEditorial = Request::get("idEditorial");
$r = $gestor->delete($idEditorial);

header("Location:editbooks.php?op=delete&r=$r");
