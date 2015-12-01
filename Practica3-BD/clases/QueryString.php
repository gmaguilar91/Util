<?php

class QueryString {
    private $params;

    function __construct() {
        $this->params = $_GET;
    }

    function getParamsWithout($parametrosDelete){
        return $this->getParams(array(), $parametrosDelete);
    }

    function getParams($parametrosAdd = array(), $parametrosDelete = array()) {
        $copia = $this->params;
        foreach ($parametrosDelete as $parametro => $valor){
            unset($copia[$parametro]);
        }
        $r = "";
        foreach ($copia as $parametro => $valor){
            $r .= $parametro. "=". urlencode($valor)."&";
        }
        return substr($r, 0, -1);
    }
}
