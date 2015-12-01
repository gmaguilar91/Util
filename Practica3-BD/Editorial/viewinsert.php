<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageEditorial($bd);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpinsert.php">
            Editorial<input type="text" name="idEditorial" value="" required=""/><br/>
            Nombre<input type="text" name="nombre" value="" required=""/><br/>
            Pais<input type="text" name="pais" value="" required=""/><br/>
            <input type="submit" name="insertar" value="Insertar"/>
        </form>
    </body>
</html>