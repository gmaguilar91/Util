<?php
require 'clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageLibros($bd);
$gestorAutores = new ManageAutores($bd);
$gestorEditorial = new ManageEditorial($bd);

$registros = $gestor->count();
$pages = ceil($registros / Constants::NRPP);
$page = Request::get("page");

$order = Request::get("order");
$sort = Request::get("sort");
$orden = "$order $sort";
$trozoEnlace = "";
if (trim($orden) != "") {
    $trozoEnlace = "&order=$order&sort=$sort";
}

if ($page === null || $page === "") {
    $page = 1;
}

$libreria = $gestor->getList($page, trim($orden));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="estilo.css">
        <title>Biblioteca</title>
    </head>
    <body>
        <h1>Bienvenido, estos son los libros de los que dispone: </h1>
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
                </tr>
            </thead>
            <tfoot>
            <td colspan="8" style="text-align: center;">
                <a href="index.php?page=1<?php echo $trozoEnlace ?>">Primero</a>
                <a href="index.php?page=<?php echo max(1, $page - 1) . $trozoEnlace; ?>">Anterior</a>
                <a href="index.php?page=<?php echo min($page + 1, $pages) . $trozoEnlace; ?>">Siguiente</a>
                <a href="index.php?page=<?php echo $pages . $trozoEnlace ?>">Ultimo</a>
            </td>
        </tfoot>
        <tbody>
            <?php
            foreach ($libreria as $indice => $libro) {
                $editorial = $gestorEditorial->get($libro->getIdEditorial());
                $autor = $gestorAutores->get($libro->getIdAutores());
                ?>
                <tr>
                    <td><?php echo $libro->getIsbn(); ?></td>
                    <td><?php echo $libro->getTitulo(); ?></td>
                    <td><?php echo $editorial->getNombre(); ?></td>
                    <td><?php echo $autor->getNombre(). " " . $autor->getApellidos(); ?></td>
                    <td><?php echo $libro->getPaginas(); ?></td>
                    <td><?php echo $libro->getIdGeneros(); ?></td>
                    <td><?php echo $libro->getIdCategorias(); ?></td>
                    <td><?php echo $libro->getAnioEdicion(); ?></td>
                </tr>
<?php } ?>
        </tbody>
    </table>
    <br/>
    <form action="iniciarsesion.php" method="post">
        <input type="submit" value="Login"/>
    </form>
</body>
</html>
