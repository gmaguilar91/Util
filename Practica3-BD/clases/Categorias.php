<?php

class Categorias {

    private $idCategorias;

    function __construct($idCategorias = null) {
        $this->idCategorias = $idCategorias;
    }

    function getIdCategorias() {
        return $this->idCategorias;
    }

    function setIdCategorias($idCategorias) {
        $this->idCategorias = $idCategorias;
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
