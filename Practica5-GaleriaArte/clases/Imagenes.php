<?php

class Imagenes {

    private $id, $email, $categoria, $ruta;

    function __construct($id = "", $email = "", $categoria = "", $ruta = "") {
        $this->id = $id;
        $this->email = $email;
        $this->categoria = $categoria;
        $this->ruta = $ruta;
    }
    
    function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getRuta() {
        return $this->ruta;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    public function getJson() {
        $r = '{';

        foreach ($this as $indice => $valor) {
            $r .= '"' . $indice . '":' . json_encode($valor) . ',';
        }
        $r = substr($r, 0, -1);
        $r .= '}';
        return $r;
    }

    public function __toString() {
        $r = '';
        foreach ($this as $key => $valor) {
            $r .= "$valor ";
        }
        return $r . "<br/>";
    }

    function set($valores, $inicio = 0) {
        $i = 0;

        foreach ($this as $indice => $valor) {
            $this->$indice = $valores[$i + $inicio];
            $i++;
        }
    }

}
