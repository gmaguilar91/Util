<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibros($bd);
$isbn = Request::get("isbn");
$libro = $gestor->get($isbn);
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
        <form method="POST" action="phpedit.php">
            Isbn<input type="text" name="isbn" value="<?php echo $libro->getIsbn(); ?>" /><br/>
            Titulo<input type="text" name="titulo" value="<?php echo $libro->getTitulo(); ?>" /><br/>
            Editorial<?php echo Util::getSelect("idEditorial", $gestorEditorial->getValuesSelect(), $libro->getIdEditorial(), false) ?><br/>
            Autores<?php echo Util::getSelect("idAutores", $gestorAutores->getValuesSelect(), $libro->getIdAutores(), false) ?><br/>
            Paginas<input type="text" name="paginas" value="<?php echo $libro->getPaginas(); ?>" /><br/>
            Genero<?php echo Util::getSelect("idGeneros", $gestorGeneros->getValuesSelect(), $libro->getIdGeneros(), false) ?><br/>
            Categoria<?php echo Util::getSelect("idCategorias", $gestorCategorias->getValuesSelect(), $libro->getIdCategorias(), false) ?><br/>
            Año Edición<input type="number" name="anioEdicion" value="<?php echo $libro->getAnioEdicion(); ?>" /><br/>
            Precio<input type="number" step="any" name="precio" value="<?php echo $libro->getPrecio(); ?>"/><br/>
            Prestado<input type="checkbox" name="prestado" value="<?php echo $libro->getPrestado(); ?>"/><br/>
            <input type="hidden" name="pkisbn" value="<?php echo $libro->getIsbn()?>" /><br/>
            <input type="submit" name="editar" value="Editar"/>
        </form>
    </body>
</html>
