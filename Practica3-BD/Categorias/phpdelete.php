<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCategorias($bd);
$categoria = Request::get("idCategorias");
$r = $gestor->delete($categoria);

header("Location:categories.php?op=delete&r=$r");
