<?php

class Paginacion {

    private $registros, $rpp, $paginaActual, $paginasTotal;

    function __construct($registros, $rpp = Constantes::NRPP, $paginaActual = 1) {
        if($rpp === null){
           $rpp = Constants::NRPP;
        }
        if($paginaActual === null){
            $paginaActual = 1;
        }
        $this->registros = $registros;
        $this->rpp = $rpp;
        $this->paginaActual = $paginaActual;
    }

    function getRegistros() {
        return $this->registros;
    }

    function getRpp() {
        return $this->rpp;
    }

    function getPaginaActual() {
        return $this->paginaActual;
    }

    function getPrimera(){
        return 1;
    }

    function getAnterior(){
        return max(1, $this->paginaActual - 1);
    }

    function getSelect($id, $name = null){
        if($name === null){
            $name = $id;
        }
        $array = array(10=>"10 rpp", 50=>"50 rpp", 100=>"100 rpp");
        return Util::getSelect($name, $array, $this->rpp, false, "", $id);
    }

    function getSiguiente(){
        return min($this->paginaActual + 1, $this->paginasTotal);
    }

    function getPaginas(){
        $this->paginasTotal = ceil($this->registros / $this->rpp);
        return $this->paginasTotal;
    }

    function setRegistros($registros) {
        $this->registros = $registros;
    }

    function setRpp($rpp) {
        $this->rpp = $rpp;
    }

    function setPaginaActual($paginaActual) {
        $this->paginaActual = $paginaActual;
    }   

    function getEnlacesPaginas($rango, $enlace, $nombreParametroPagina, $pagina = 0){
        
    }

}