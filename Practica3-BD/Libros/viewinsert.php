<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibros($bd);
$gestorEditorial = new ManageEditorial($bd);
$gestorGeneros = new ManageGeneros($bd);
$gestorCategorias = new ManageCategorias($bd);
$gestorAutores = new ManageAutores($bd);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpinsert.php">
            Isbn<input type="text" name="isbn" value="" required=""/><br/>
            Titulo<input type="text" name="titulo" value="" required=""/><br/>
            Editorial<?php echo Util::getSelect("idEditorial", $gestorEditorial->getValuesSelect(), null) ?><br/>
            Autores<?php echo Util::getSelect("idAutores", $gestorAutores->getValuesSelect(), null) ?><br/>
            Paginas<input type="number" name="paginas" value="" /><br/>
            Genero<?php echo Util::getSelect("idGeneros", $gestorGeneros->getValuesSelect(), null) ?><br/>
            Categoria<?php echo Util::getSelect("idCategorias", $gestorCategorias->getValuesSelect(), null) ?><br/>
            Año Edición<input type="number" name="anioEdicion" value="" required=""/><br/>
            Precio<input type="number" step="any" name="precio" value="" required=""/><br/>
            <input type="submit" name="insertar" value="Insertar"/>
        </form>
    </body>
</html>
