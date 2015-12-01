<?php

class ManageLibros {

    private $bd = null;
    private $tabla = "libros";

    function __construct(Database $bd) {
        $this->bd = $bd;
    }

    function get($isbn) {
        $parametros = array();
        $parametros["isbn"] = $isbn;
        $condicion = "isbn=:isbn";
        $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();
        $libro = new Libros ($fila[0],$fila[1],$fila[2],$fila[3],$fila[4],$fila[5],$fila[6],$fila[7],$fila[8],$fila[9]);
        return $libro;
    }

    function count($condicion = "1=1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($isbn) {
        $parametros = array();
        $parametros["isbn"] = $isbn;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Libros $libro) {
        return $this->delete($libro->getIsbn());
    }

    function set(Libros $libro, $pk) {
        $parametrosSet = array();
        $parametrosSet["isbn"] = $libro->getIsbn();
        $parametrosSet["titulo"] = $libro->getTitulo();
        $parametrosSet["idEditorial"] = $libro->getIdEditorial();
        $parametrosSet["idAutores"] = $libro->getIdAutores();
        $parametrosSet["paginas"] = $libro->getPaginas();
        $parametrosSet["idGeneros"] = $libro->getIdGeneros();
        $parametrosSet["idCategorias"] = $libro->getIdCategorias();
        $parametrosSet["anioEdicion"] = $libro->getAnioEdicion();
        $parametrosSet["precio"] = $libro->getPrecio();
        $parametrosSet["prestado"] = $libro->getPrestado();

        $parametrosWhere = array();
        $parametrosWhere["isbn"] = $pk;
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Libros $libro) {
        $parametrosSet = array();
        $parametrosSet["isbn"] = $libro->getIsbn();
        $parametrosSet["titulo"] = $libro->getTitulo();
        $parametrosSet["idEditorial"] = $libro->getIdEditorial();
        $parametrosSet["idAutores"] = $libro->getIdAutores();
        $parametrosSet["paginas"] = $libro->getPaginas();
        $parametrosSet["idGeneros"] = $libro->getIdGeneros();
        $parametrosSet["idCategorias"] = $libro->getIdCategorias();
        $parametrosSet["anioEdicion"] = $libro->getAnioEdicion();
        $parametrosSet["precio"] = $libro->getPrecio();
        $parametrosSet["prestado"] = $libro->getPrestado();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenpredeterminado = "$orden, isbn, titulo";
        if (trim($orden) === "" || trim($orden) === null) {
            $ordenpredeterminado = "isbn, titulo";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenpredeterminado, $registroInicial . "," . $nrpp);
        $resultado = array();
        while ($fila = $this->bd->getRow()) {
            $libro = new Libros();
            $libro->set($fila);
            $resultado[] = $libro;
        }

        return $resultado;
    }
    
    function getValuesSelect() {
        $this->bd->query($this->tabla, "isbn, titulo", array(), "isbn");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

}
