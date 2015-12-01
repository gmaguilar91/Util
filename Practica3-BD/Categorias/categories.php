<?php
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageCategorias($bd);
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

$categorias = $gestor->getList($page, trim($orden));
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
        <h1>Estos son las categorias,  <?php echo $sesion->get("user") ?></h1>
        <?php
        if ($op != null) {
            echo "<h2>La operacion $op ha dado como resultado $r.</h2>";
        }
        ?>
        <nav>
            <a href="../Libros/books.php">Libros</a>
            <a href="../Autores/writers.php">Autores</a>
            <a href="../Editorial/editbooks.php">Editoriales</a>
            <a href="../Generos/genders.php">Generos</a>
            <a href="categories.php">Categorias</a>
        </nav>
        <br/>
        <a href="viewinsert.php">Nueva categoria</a>
        <table border="1">
            <thead>
                <tr>
                    <th>Código 
                        <a href="?order=idCategorias&sort=desc">&Del;</a>
                        <a href="?order=idCategorias&sort=asc">&Delta;</a>
                    </th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tfoot>
            <td colspan="3">
                <a href="categories.php?page=1<?php echo $trozoEnlace ?>">Primero</a>
                <a href="categories.php?page=<?php echo max(1, $page - 1) . $trozoEnlace; ?>">Anterior</a>
                <a href="categories.php?page=<?php echo min($page + 1, $pages) . $trozoEnlace; ?>">Siguiente</a>
                <a href="categories.php?page=<?php echo $pages . $trozoEnlace ?>">Ultimo</a>
            </td>
        </tfoot>
        <tbody>
            <?php foreach ($categorias as $indice => $categoria) { ?>
                <tr>
                    <td><?php echo $categoria->getIdCategorias() ?></td>
                    <td>
                        <a class="borrar" href='phpdelete.php?idCategorias=<?php echo $categoria->getIdCategorias() ?>'>Borrar </a>
                        <a href='viewedit.php?idCategorias=<?php echo $categoria->getIdCategorias() ?>'>Editar</a>
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
