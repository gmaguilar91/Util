<?php

class Editorial {

    private $idEditorial, $nombre, $pais;

    function __construct($idEditorial = null, $nombre = null , $pais = null) {
        $this->idEditorial = $idEditorial;
        $this->nombre = $nombre;
        $this->pais = $pais;
    }

    function getIdEditorial() {
        return $this->idEditorial;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPais() {
        return $this->pais;
    }

    function setIdEditorial($idEditorial) {
        $this->idEditorial = $idEditorial;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setPais($pais) {
        $this->pais = $pais;
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
