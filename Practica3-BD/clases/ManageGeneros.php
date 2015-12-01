<?php

class ManageGeneros {
    private $bd = null;
    private $tabla = "generos";
    
    function __construct(Database $bd) {
        $this->bd = $bd;
    }
    
    function get($idGeneros) {
        $parametros = array();
        $parametros["idGeneros"] = $idGeneros;
        $condicion = "idGeneros=:idGeneros";
        $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();
        $genero = new Generos($fila[0]);
        return $genero;
    }
    
     function count($condicion = "1=1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($ID) {
        $parametros = array();
        $parametros["idGeneros"] = $ID;
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Generos $genero) {
        return $this->delete($genero->getIdGeneros());
    }

    function set(Generos $genero, $pk) {
        $parametrosSet = array();
        $parametrosSet["idGeneros"] = $genero->getIdGeneros();

        $parametrosWhere = array();
        $parametrosWhere["idGeneros"] = $pk;
        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }

    function insert(Generos $genero) {
        $parametrosSet = array();
        $parametrosSet["idGeneros"] = $genero->getIdGeneros();
        return $this->bd->insert($this->tabla, $parametrosSet);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenpredeterminado = "$orden, idGeneros";
        if (trim($orden) === "" || trim($orden) === null) {
            $ordenpredeterminado = "idGeneros";
        }
        $registroInicial = ($pagina - 1) * $nrpp;
        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenpredeterminado, $registroInicial . "," . $nrpp);
        $resultado = array();
        while ($fila = $this->bd->getRow()) {
            $genero = new Generos();
            $genero->set($fila);
            $resultado[] = $genero;
        }

        return $resultado;
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "idGeneros", array(), "idGeneros");
        $array = array();
        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila[0];
        }
        return $array;
    }


}
