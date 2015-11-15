<?php

class Database {

    private $conexion, $consulta;

    public function __construct() {
        try {
            $this->conexion = new PDO(
                    'mysql:host=' . Constants::SERVER . ';dbname=' . Constants::DATABASE, Constants::DBUSER, Constants::DBPASSWORD, array(
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
                    )
            );
        } catch (PDOException $e) {
            /* Esta parte hay que trabajarla */
            var_dump($e);
            exit();
        };
    }

    function close() {
        $this->conexion = null;
    }

    function getCount() {
        return $this->consulta->rowCount();
    }

    function getId() {
        return $this->conexion->lastInsertId();
    }

    function getErrorConection() {
        return $this->conexion->errorInfo();
    }

    function getError() {
        return $this->consulta->errorInfo();
    }

    function send($sql, $parametros = array()) {
        $this->consulta = $this->conexion->prepare($sql);

        foreach ($parametros as $nombreParametro => $valorParametro) {
            $this->consulta->bindValue($nombreParametro, $valorParametro);
        }

        return $this->consulta->execute();
    }

    function getRow() {
        $r = $this->consulta->fetch();

        if ($r === null) {
            $this->consulta->closeCursor();
        }

        return $r;
    }

    function delete() {
        //Delete from TABLA where CONDICION
        $sql = "delete from $tabla where $condicion";
        ;
        if ($this->send($sql, $parametros)) {
            return $this->getCount();
        }
        return FALSE;
    }

    function insert($tabla, $parametros = array(), $auto = true) {
        //insert into TABLA values (VALORES);
        //insert into TABLA(CAMPOS) values (VALORES);
        //si el id es autonumerico devuelvo el id 
        //si no, devuelvo las columnas afectadas
        //si error devuelvo false

        $sql = "insert into $tabla";
        $campos = "";
        $valores = "";
        foreach ($parametros as $nombreParametros => $valorParametro) {
            $campos .= $nombreParametros . ",";
            $valores .= ":" . $nombreParametros . ",";
        }
        $campos = substr($campos, 0, -1);
        $valores = substr($valores, 0, -1);
        $sql = "insert into $tabla ($campos) values ($valores)";

        if ($this->send($sql, $parametros)) {
            if ($auto) {
                return $this->getId();
            }
            return $this->getCount();
        }
        return false;
    }

    function update($tabla, $parametrosSet = array(), $parametrosWhere = array()) {
        // update TABLA set VALORES where CONDICION
        // update TABLA set c1=:c1, c2=:c2 where c1=:c1 and c3=:c3

        $camposSet = "";
        $camposWhere = "";
        $parametros = array();
        foreach ($parametrosSet as $nombreParametros => $valorParametro) {
            $camposSet .= $nombreParametros . " = :_" . $nombreParametros . ";";
            $parametros[$nombreParametros] = $valorParametro;
        }
        $camposSet = substr($camposSet, 0, -1);
        foreach ($parametrosWhere as $nombreParametros => $valorParametro) {
            $camposSet .= $nombreParametros . " = :_" . $nombreParametros . " and";
            $parametros["_" . $nombreParametros] = $valorParametro;
        }
        $camposWhere = substr($camposWhere, 0, -4);
        $sql = "update $tabla set $camposSet where $camposWhere";
        
        if ($this->send($sql, $parametros)) {
            return $this->getCount();
        }
        return false;
    }
    
    function query ($tabla, $proyeccion = "*", $parametros = array(), $orden = "1", $limite = ""){
        //select CAMPOS from TABLA where CONDICION order by ORDEN LIMIT
        //select c1,c2 from TABLA where c3=:c3 and c4=:c4 order by c2 desc, c1 limit 8.15
        $campos = "";
        foreach ($parametros as $nombreParametros => $valorParametro) {
            $campos .= $nombreParametros . " = :" . $nombreParametros . " and";
        }
        //$campos .= "1=1"; Esto nunca falla
        $campos = substr($campos, 0, -4);
        $limite = "";
        if ($limite !== "") {
            $limit = "limit $limite";
        }
        $sql = "select $proyeccion from $tabla"
            . "where $campos order by $orden $limit";
        return $this->send($sql, $parametros);
    }

}
