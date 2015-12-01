<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibros($bd);

$isbn = Request::post("isbn");
$titulo = Request::post("titulo");
$idEditorial = Request::post("idEditorial");
$idAutores = Request::post("idAutores");
$paginas = Request::post("paginas");
$idGeneros = Request::post("idGeneros");
$idCategorias = Request::post("idCategorias");
$anioEdicion = Request::post("anioEdicion");
$precio = Request::post("precio");

$libro = new Libros($isbn, $titulo, $idEditorial, $idAutores, $paginas, $idGeneros, $idCategorias, $anioEdicion, $precio);

$r = $gestor->insert($libro);

$bd->close();
echo "<br/>";
header("Location:books.php?op=insert&r=$r");
