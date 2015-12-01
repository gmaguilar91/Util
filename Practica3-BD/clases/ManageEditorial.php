<?php

class ManageEditorial {

    private $bd = null;
    private $tabla = "editorial";

    function __construct(Database $bd) {
        $this->bd = $bd;
    }

    function get($idEditorial) {
        $parametros = array();
        $parametros["idEditorial"] = $idEditorial;
        $condicion = "idEditorial=:idEditorial";
        $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();
        $editorial = new Editorial($fila[0], $fila[1], $fila[2]);
        return $editorial;
    }

    function count($condicion = "1=1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($ID) {
        $parametros = array();
        $parametros["idEditorial"] = $ID;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Editorial $editorial) {
        return $this->delete($editorial->getIdEditorial());
    }

    function set(Editorial $editorial, $pk) {
        $parametrosSet = array();
        $parametrosSet["idEditorial"] = $editorial->getIdEditorial();
        $parametrosSet["nombre"] = $editorial->getNombre();
        $parametrosSet["pais"] = $editorial->getPais();

        $parametrosWhere = array();
        $parametrosWhere["idEditorial"] = $pk;
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Editorial $editorial) {
        $parametrosSet = array();
        $parametrosSet["idEditorial"] = $editorial->getIdEditorial();
        $parametrosSet["nombre"] = $editorial->getNombre();
        $parametrosSet["pais"] = $editorial->getPais();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenpredeterminado = "$orden, idEditorial";
        if (trim($orden) === "" || trim($orden) === null) {
            $ordenpredeterminado = "idEditorial";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenpredeterminado, $registroInicial . "," . $nrpp);
        $resultado = array();
        while ($fila = $this->bd->getRow()) {
            $editorial = new Editorial();
            $editorial->set($fila);
            $resultado[] = $editorial;
        }

        return $resultado;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "idEditorial, nombre", array(), "idEditorial");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[1];
        }
        return $array;
    }

}
