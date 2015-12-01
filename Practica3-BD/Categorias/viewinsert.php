<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCategorias($bd);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpinsert.php">
            Categoría<input type="text" name="idCategorias" value="" required=""/><br/>
            <input type="submit" name="insertar" value="Insertar"/>
        </form>
    </body>
</html>