<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutores($bd);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpinsert.php">
            Codigo<input type="text" name="idAutores" value="" required=""/><br/>
            Nombre<input type="text" name="nombre" value="" required=""/><br/>
            Apellidos<input type="text" name="apellidos" value="" required=""/><br/>  
            Nacionalidad<input type="text" name="nacionalidad" value="" required=""/><br/>
            <input type="submit" name="insertar" value="Insertar"/>
        </form>
    </body>
</html>