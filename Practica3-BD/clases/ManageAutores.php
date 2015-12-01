<?php

class ManageAutores {

    private $bd = null;
    private $tabla = "autores";

    function __construct(Database $bd) {
        $this->bd = $bd;
    }

    function get($idAutores) {
        $parametros = array();
        $parametros["idAutores"] = $idAutores;
        $condicion = "idAutores=:idAutores";
        $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();
        $autor = new Autores($fila[0], $fila[1], $fila[2], $fila[3]);
        return $autor;
    }

    function count($condicion = "1=1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($ID) {
        $parametros = array();
        $parametros["idAutores"] = $ID;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Autores $autor) {
        return $this->delete($autor->getIdAutores());
    }

    function set(Autores $autor, $pk) {
        $parametrosSet = array();
        $parametrosSet["idAutores"] = $autor->getIdAutores();
        $parametrosSet["nombre"] = $autor->getNombre();
        $parametrosSet["apellidos"] = $autor->getApellidos();
        $parametrosSet["nacionalidad"] = $autor->getNacionalidad();

        $parametrosWhere = array();
        $parametrosWhere["idAutores"] = $pk;
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Autores $autor) {
        $parametrosSet = array();
        $parametrosSet["idAutores"] = $autor->getIdAutores();
        $parametrosSet["nombre"] = $autor->getNombre();
        $parametrosSet["apellidos"] = $autor->getApellidos();
        $parametrosSet["nacionalidad"] = $autor->getNacionalidad();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenpredeterminado = "$orden, idAutores";
        if (trim($orden) === "" || trim($orden) === null) {
            $ordenpredeterminado = "idAutores";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenpredeterminado, $registroInicial . "," . $nrpp);
        $resultado = array();
        while ($fila = $this->bd->getRow()) {
            $autor = new Autores();
            $autor->set($fila);
            $resultado[] = $autor;
        }

        return $resultado;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "idAutores, nombre, apellidos", array(), "idAutores");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1]." ".$fila[2];
        }
        return $array;
    }

}
