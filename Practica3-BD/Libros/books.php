<?php
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageLibros($bd);
$gestorEditorial = new ManageEditorial($bd);
$gestorAutores = new ManageAutores($bd);
$registros = $gestor->count();

$pages = ceil($registros / Constants::NRPP);
$page = Request::get("page");
if ($page === null || $page === "") {
    $page = 1;
}

$order = Request::get("order");
$sort = Request::get("sort");
$orden = "$order $sort";
$trozoEnlace = "";
if (trim($orden) != "") {
    $trozoEnlace = "&order=$order&sort=$sort";
}

$libreria = $gestor->getList($page, trim($orden));
$op = Request::get("op");
$r = Request::get("r");
$sesion = new Session();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href=".css">
        <title>Biblioteca</title>
    </head>
    <body>
        <h1>Estos son sus libros,  <?php echo $sesion->get("user") ?></h1>
        <?php
        if ($op != null) {
            echo "<h2>La operacion $op ha dado como resultado $r.</h2>";
        }
        ?>
        <nav>
            <a href="books.php">Libros</a>
            <a href="../Autores/writers.php">Autores</a>
            <a href="../Editorial/editbooks.php">Editoriales</a>
            <a href="../Generos/genders.php">Generos</a>
            <a href="../Categorias/categories.php">Categorias</a>
        </nav>
        <br/>
        <a href="viewinsert.php">Agregar libro</a>
        <table border="1">
            <thead>
                <tr>
                    <th>Isbn
                        <a href="?order=isbn&sort=desc">&Del;</a>
                        <a href="?order=isbn&sort=asc">&Delta;</a>
                    </th>
                    <th>Titulo
                        <a href="?order=titulo&sort=desc">&Del;</a>
                        <a href="?order=titulo&sort=asc">&Delta;</a></th>
                    <th>Editorial
                        <a href="?order=idEditorial&sort=desc">&Del;</a>
                        <a href="?order=idEditorial&sort=asc">&Delta;</a>
                    </th>
                    <th>Autor
                        <a href="?order=idAutores&sort=desc">&Del;</a>
                        <a href="?order=idAutores&sort=asc">&Delta;</a>
                    </th>
                    <th>Páginas
                        <a href="?order=paginas&sort=desc">&Del;</a>
                        <a href="?order=paginas&sort=asc">&Delta;</a>
                    </th>
                    <th>Género
                        <a href="?order=idGeneros&sort=desc">&Del;</a>
                        <a href="?order=idGeneros&sort=asc">&Delta;</a>
                    </th>
                    <th>Categorias
                        <a href="?order=idCategorias&sort=desc">&Del;</a>
                        <a href="?order=idCategorias&sort=asc">&Delta;</a>                        
                    </th>
                    <th>Año Edición
                        <a href="?order=anioEdicion&sort=desc">&Del;</a>
                        <a href="?order=anioEdicion&sort=asc">&Delta;</a>
                    </th>
                    <th>Precio
                        <a href="?order=precio&sort=desc">&Del;</a>
                        <a href="?order=precio&sort=asc">&Delta;</a>
                    </th>
                    <th>¿Prestado?
                        <a href="?order=prestado&sort=desc">&Del;</a>
                        <a href="?order=prestado&sort=asc">&Delta;</a>
                    </th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tfoot>
            <td colspan="11">
                <a href="books.php?page=1<?php echo $trozoEnlace ?>">Primero</a>
                <a href="books.php?page=<?php echo max(1, $page - 1) . $trozoEnlace; ?>">Anterior</a>
                <a href="books.php?page=<?php echo min($page + 1, $pages) . $trozoEnlace; ?>">Siguiente</a>
                <a href="books.php?page=<?php echo $pages . $trozoEnlace ?>">Ultimo</a>
            </td>
        </tfoot>
        <tbody>
            <?php foreach ($libreria as $indice => $libro) { 
                $editorial = $gestorEditorial->get($libro->getIdEditorial());
                $autor = $gestorAutores->get($libro->getIdAutores());
                ?>
                <tr>
                    <td><?php echo $libro->getIsbn() ?></td>
                    <td><?php echo $libro->getTitulo() ?></td>
                    <td><?php echo $editorial->getNombre(); ?></td>
                    <td><?php echo $autor->getNombre(). " " . $autor->getApellidos(); ?></td>
                    <td><?php echo $libro->getPaginas() ?></td>
                    <td><?php echo $libro->getIdGeneros() ?></td>
                    <td><?php echo $libro->getIdCategorias() ?></td>
                    <td><?php echo $libro->getAnioEdicion() ?></td>
                    <td><?php echo $libro->getPrecio() ?></td>
                    <td><?php echo $libro->getPrestado() ?></td>
                    <td>
                        <a class="borrar" href='phpdelete.php?isbn=<?php echo $libro->getIsbn() ?>'>Borrar </a>
                        <a href='viewedit.php?isbn=<?php echo $libro->getIsbn() ?>'>Editar</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br/>
    <form action="../desconexion.php" method="post">
        <input type="submit" value="Logout"/>
    </form>
    <script src="../js/script.js"></script>
</body>
</html>
