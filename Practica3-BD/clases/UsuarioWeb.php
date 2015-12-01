<?php

class UsuarioWeb {
    private $nombre,$apellidos,$login,$alias,$pass,$email,$sexo,$fechaNac,$isAdmin,$isWorker,$isActive,$fechaAlta;
    
    function __construct($nombre=null, $apellidos=null, $login=null, $alias=null, $pass=null, $email=null, $sexo=null, $fechaNac=null,
            $fechaAlta=null,$isAdmin="no", $isWorker="no", $isActive="no") {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->login = $login;
        $this->alias = $alias;
        $this->pass = $pass;
        $this->email = $email;
        $this->sexo = $sexo;
        $this->fechaNac = $fechaNac;
        $this->isAdmin = $isAdmin;
        $this->isWorker = $isWorker;
        $this->isActive = $isActive;
        $this->fechaAlta = $fechaAlta;
    }
    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getLogin() {
        return $this->login;
    }

    function getAlias() {
        return $this->alias;
    }

    function getPass() {
        return $this->pass;
    }

    function getEmail() {
        return $this->email;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFechaNac() {
        return $this->fechaNac;
    }

    function getIsAdmin() {
        return $this->isAdmin;
    }

    function getIsWorker() {
        return $this->isWorker;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function getFechaAlta() {
        return $this->fechaAlta;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setAlias($alias) {
        $this->alias = $alias;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFechaNac($fechaNac) {
        $this->fechaNac = $fechaNac;
    }

    function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }

    function setIsWorker($isWorker) {
        $this->isWorker = $isWorker;
    }

    function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    function setFechaAlta($fechaAlta) {
        $this->fechaAlta = $fechaAlta;
    }

    static function userAlias($mail=null){
        if(isset($mail)){
            $pos = strpos($mail, "@");
            $alias = substr($mail, 0, $pos);
            return $alias;
        }
        return null;
    }
    
    public function __toString() {
        $user = "Nombre: ".$this->nombre. "<br/>".
                "Apellidos: ".$this->apellidos. "<br/>".
                "Login: ".$this->login. "<br/>".
                "Alias: ".$this->alias. "<br/>".
                "Contraseña: ".$this->pass. "<br/>".
                "Email: ".$this->email. "<br/>".
                "Sexo: ".$this->sexo. "<br/>".
                "Fecha nacimiento: ".$this->fechaNac. "<br/>".
                "Es Administrador: ".$this->isAdmin. "<br/>".
                "Es trabajador: ".$this->isWorker. "<br/>".
                "Está activo: ".$this->isActive. "<br/>".
                "Fecha Alta: ".$this->fechaAlta. "<br/>";
        return $user;
    }    
}
