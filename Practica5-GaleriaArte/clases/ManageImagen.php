<?php

class ManageImagen {

    private $bd = null;
    private $tabla = "imagenes";

    function __construct(DataBase $bd) {
        $this->bd = $bd;
    }

    function get($email) {
        $parametros = array();
        $parametros["email"] = $email;
        $condicion = "email = :email";
        $resultadoSQL = $this->bd->select($this->tabla, "*", $condicion, $parametros);

        $fila = $this->bd->getRow();

        $imagenes = new Imagenes($fila[0], $fila[1], $fila[2], $fila[3]);

        return $imagenes;
    }

    function count($condicion = "1 = 1", $parametros = array()) {
        return $this->bd->count($this->tabla, $condicion, $parametros);
    }

    function delete($email) {
        $parametros = array();
        $parametros["email"] = $email;

        return $this->bd->delete($this->tabla, $parametros);
    }

    function deleteImagen($parametros) {
        return $this->bd->delete($this->tabla, $parametros);
    }

    function erase(Imagenes $imagen) {
        return $this->delete($imagen->getnombre());
    }

    function setImagen(Imagenes $imagen, $pkEmail) {
        $parametrosSet = array();
        $parametrosWhere = array();
    
        $parametrosSet['email'] = $imagen->getEmail();
        $parametrosSet['categoria'] = $imagen->getCategoria();
        $parametrosSet['ruta'] = $imagen->getRuta();
        
        $parametrosWhere['email'] = $pkEmail;

        return $this->bd->update($this->tabla, $parametrosSet, $parametrosWhere);
    }
    
    function insert(Imagenes $imagen) {
        $parametros = array();
        
        $parametros['email'] = $imagen->getEmail();
        $parametros['categoria'] = $imagen->getCategoria();
        $parametros['ruta'] = $imagen->getRuta();

        return $this->bd->insert($this->tabla, $parametros);
    }

    function getList($pagina = 1, $orden = "", $nrpp = Constants::NRPP) {
        $ordenPredeterminado = "$orden, id, email, categoria, ruta";

        if ($orden === "" || $orden === null) {
             $ordenPredeterminado = "id, email, categoria, ruta";
        }

        $registroInicial = ($pagina - 1) * $nrpp;

        $this->bd->select($this->tabla, "*", "1=1", array(), $ordenPredeterminado, "$registroInicial, $nrpp");

        $r = array();

        while ($fila = $this->bd->getRow()) {
            $imagen = new Imagenes();
            $imagen->set($fila);

            $r[] = $imagen;
        }
        return $r;//Devuelve un array de Imagenes
    }

    function getValuesSelect() {
        $this->bd->query($this->tabla, "nombre", array(), "nombre");

        $array = array();

        while ($fila = $this->bd->getRow()) {
            $array[$fila[0]] = $fila [0];
        }
        
        return $array;
    }
}
