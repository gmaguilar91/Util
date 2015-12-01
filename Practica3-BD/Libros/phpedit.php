<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibros($bd);
$pkisbn = Request::post("pkisbn");
$isbn = Request::post("isbn");
$titulo = Request::post("titulo");
$idEditorial = Request::post("idEditorial");
$idAutores = Request::post("idAutores");
$paginas = Request::post("paginas");
$idGeneros = Request::post("idGeneros");
$idCategorias = Request::post("idCategorias");
$anioEdicion = Request::post("anioEdicion");
$precio = Request::post("precio");
$prestado = Request::post("prestado");
if($prestado == 0){
    $prestado = 1;
}

$libro = new Libros($isbn, $titulo, $idEditorial, $idAutores, $paginas, $idGeneros, $idCategorias, $anioEdicion, $precio);
$libro->setPrestado($prestado);
$r = $gestor->set($libro, $pkisbn);

$bd->close();
echo "<br/>";
header("Location:books.php?op=edit&r=$r");