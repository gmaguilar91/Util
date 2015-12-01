<?php

class Autores {

    private $idAutores, $nombre, $apellidos, $nacionalidad;

    function __construct($idAutores = null, $nombre = null, $apellidos = null, $nacionalidad = null) {
        $this->idAutores = $idAutores;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->nacionalidad = $nacionalidad;
    }

    function getIdAutores() {
        return $this->idAutores;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getNacionalidad() {
        return $this->nacionalidad;
    }

    function setIdAutores($idAutores) {
        $this->idAutores = $idAutores;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
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
