<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCategorias($bd);
$idCategorias = Request::post("idCategorias");
$pkidCategorias = Request::post("pkidCategorias");

$categoria = new Categorias($idCategorias);
$r = $gestor->set($categoria, $pkidCategorias);

$bd->close();
header("Location:categories.php?op=edit&r=$r");