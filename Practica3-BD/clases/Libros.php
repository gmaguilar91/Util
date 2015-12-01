<?php

class Libros {

    private $isbn, $titulo, $idEditorial, $idAutores, $paginas, $idGeneros, $idCategorias, $anioEdicion, $precio, $prestado = false;

    function __construct($isbn = null, $titulo = null, $idEditorial = null, $idAutores = null, $paginas = null, $idGeneros = null, $idCategorias = null, $anioEdicion = null, $precio = null, $prestado = false) {
        $this->isbn = $isbn;
        $this->titulo = $titulo;
        $this->idEditorial = $idEditorial;
        $this->idAutores = $idAutores;
        $this->paginas = $paginas;
        $this->idGeneros = $idGeneros;
        $this->idCategorias = $idCategorias;
        $this->anioEdicion = $anioEdicion;
        $this->precio = $precio;
        $this->prestado = $prestado;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getIdEditorial() {
        return $this->idEditorial;
    }

    function getIdAutores() {
        return $this->idAutores;
    }

    function getPaginas() {
        return $this->paginas;
    }

    function getIdGeneros() {
        return $this->idGeneros;
    }

    function getIdCategorias() {
        return $this->idCategorias;
    }

    function getAnioEdicion() {
        return $this->anioEdicion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getPrestado() {
        return $this->prestado;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setIdEditorial($idEditorial) {
        $this->idEditorial = $idEditorial;
    }

    function setIdAutores($idAutores) {
        $this->idAutores = $idAutores;
    }

    function setPaginas($paginas) {
        $this->paginas = $paginas;
    }

    function setIdGeneros($idGeneros) {
        $this->idGeneros = $idGeneros;
    }

    function setIdCategorias($idCategorias) {
        $this->idCategorias = $idCategorias;
    }

    function setAnioEdicion($anioEdicion) {
        $this->anioEdicion = $anioEdicion;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    function setPrestado($prestado) {
        $this->prestado = $prestado;
    }

    function getJson() {
        $r = '{';
        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":"' . $valor . '",';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

    function set($valores, $inicio = 0) {
        $i = 0;
        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }

    function __toString() {
        $r = '';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r . "<br/>";
    }

}
