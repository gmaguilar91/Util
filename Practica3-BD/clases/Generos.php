<?php

class Generos {

    private $idGeneros;

    function __construct($idGeneros = null) {
        $this->idGeneros = $idGeneros;
    }

    function getIdGeneros() {
        return $this->idGeneros;
    }

    function setIdGeneros($idGeneros) {
        $this->idGeneros = $idGeneros;
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
