<?php

class SubirArchivo {

    private $destino = "./", $nombre = "", $tamano = "100000000", $parametro, $extension, $categoria, $cancion = "";
    private $arrayTipos = array(
        "jpg" => 1,
        "gif" => 1,
        "png" => 1,
        "jpeg" => 1,
        "text/plain" => 1,
        "mp3" => 1
    );

    const CONSERVAR = 1, RENOMBRAR = 2, REEMPLAZAR = 3;

    private $error = false, $politica = self::RENOMBRAR;

    function __construct($parametro, $categoria=    null) {
        if (isset($_FILES[$parametro]) && $_FILES[$parametro]["name"] !== "") {
            $this->parametro = $parametro;

            $nombre = $_FILES[$this->parametro]['name'];
            $trozos = pathinfo($nombre);
            $this->extension = $trozos["extension"];

            $this->nombre = $trozos["filename"];
            $this->categoria = $categoria;
        } else {
            $this->error = true;
        }
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function getDestino() {
        return $this->destino;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTamano() {
        return $this->tamano;
    }

    function getPolitica() {
        return $this->politica;
    }

    function setDestino($destino) {
        $this->destino = $destino;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function getCancion() {
        return $this->cancion;
    }

    function setCancion($cancion) {
        $this->cancion = $cancion;
    }

    function setTamano($tamano) {
        $this->tamano = $tamano;
    }

    function setPolitica($politica) {
        $this->politica = $politica;
    }

    public function upload() {
        if ($this->error) {
            return false;
        }
        if ($_FILES[$this->parametro]["error"] != UPLOAD_ERR_OK) {
            return false;
        }
        if ($_FILES[$this->parametro]["size"] > $this->tamano) {
            return false;
        }
        if ($this->isTipo($this->extension) && substr($this->destino, -1) === "/") {
            return false;
        }
        if (!is_dir($this->destino)) {
            return false;
        }

        if ($this->politica === self::CONSERVAR && file_exists($this->destino . $this->nombre . "." . $this->extension)) {
            return false;
        }

        $nombre = $this->nombre;
        if ($this->politica === self::RENOMBRAR && file_exists($this->destino . $this->nombre . "." . $this->extension)) {
            $nombre = $this->renombrar($nombre);
        }
        return move_uploaded_file($_FILES[$this->parametro]["tmp_name"], $this->destino . $nombre . "." . $this->extension);
    }

    private function renombrar($nombre) {
        $i = 1;
        while (file_exists($this->destino . $nombre . "_" . $i . "." . $this->extension)) {
            $i++;
        }
        return $nombre . "_" . $i;
    }

    public function addTipo($tipo) {
        if (!$this->isTipo($tipo)) {
            $this->arrayTipos[$tipo] = 1;
            return true;
        }
        return false;
    }

    public function removeTipo($tipo) {
        if ($this->isTipo($tipo)) {
            unset($this->arrayTipos[$tipo]);
            return true;
        }
        return false;
    }

    public function isTipo($tipo) {
        return isset($this->arrayDeTipos[$tipo]);
    }

    private function trans($files) {
        $array = array();
        foreach ($files as $indiceArchivo => $valorArray) {
            foreach ($valorArray as $numeroArchivo => $valor) {
                $array[$numeroArchivo][$indiceArchivo] = $valor;
            }
        }
        return $array;
    }

    function subirAcarpeta($user) {
        $ruta = "./users/" . $user;
        if (!is_dir($ruta)) {
            mkdir($ruta);
        }
        self::setDestino($ruta . "/");
        if (self::upload()) {
            return true;
        }
        return false;
    }

}
