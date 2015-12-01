<?php

class ManageCategorias {

    private $bd = null;
    private $tabla = "categorias";

    function __construct(Database $bd) {
        $this->bd = $bd;
    }

    function get($idCategorias) {
        $parametros = array();
        $parametros["idCategorias"] = $idCategorias;
        $condicion = "idCategorias=:idCategorias";
        $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();
        $categoria = new Categorias($fila[0]);
        return $categoria;
    }

    function count($condicion = "1=1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($ID) {
        $parametros = array();
        $parametros["idCategorias"] = $ID;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Categorias $categoria) {
        return $this->delete($categoria->getIdCategorias());
    }

    function set(Categorias $categoria, $pk) {
        $parametrosSet = array();
        $parametrosSet["idCategorias"] = $categoria->getIdCategorias();

        $parametrosWhere = array();
        $parametrosWhere["idCategorias"] = $pk;
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Categorias $categoria) {
        $parametrosSet = array();
        $parametrosSet["idCategorias"] = $categoria->getIdCategorias();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenpredeterminado = "$orden, idCategorias";
        if (trim($orden) === "" || trim($orden) === null) {
            $ordenpredeterminado = "idCategorias";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenpredeterminado, $registroInicial . "," . $nrpp);
        $resultado = array();
        while ($fila = $this->bd->getRow()) {
            $categoria = new Categorias();
            $categoria->set($fila);
            $resultado[] = $categoria;
        }

        return $resultado;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "idCategorias", array(), "idCategorias");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[0];
        }
        return $array;
    }

}
