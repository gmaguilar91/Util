<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCategorias($bd);

$idCategorias = Request::post("idCategorias");

$categoria = new Categorias($idCategorias);

$r = $gestor->insert($categoria);
$bd->close();
header("Location:categories.php?op=insert&r=$r");