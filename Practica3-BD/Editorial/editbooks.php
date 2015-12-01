<?php
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageEditorial($bd);
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

$editoriales = $gestor->getList($page, trim($orden));
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
        <h1>Estos son sus editoriales,  <?php echo $sesion->get("user") ?></h1>
        <?php
        if ($op != null) {
            echo "<h2>La operacion $op ha dado como resultado $r.</h2>";
        }
        ?>
        <nav>
            <a href="../Libros/books.php">Libros</a>
            <a href="../Autores/writers.php">Autores</a>
            <a href="editbooks.php">Editoriales</a>
            <a href="../Generos/genders.php">Generos</a>
            <a href="../Categorias/categories.php">Categorias</a>
        </nav>
        <br/>
        <a href="viewinsert.php">Nueva editorial</a>
        <table border="1">
            <thead>
                <tr>
                    <th>Código 
                        <a href="?order=idEditorial&sort=desc">&Del;</a>
                        <a href="?order=idEditorial&sort=asc">&Delta;</a>
                    </th>
                    <th>Nombre
                        <a href="?order=nombre&sort=desc">&Del;</a>
                        <a href="?order=nombre&sort=asc">&Delta;</a></th>
                    <th>Pais
                        <a href="?order=pais&sort=desc">&Del;</a>
                        <a href="?order=pais&sort=asc">&Delta;</a>
                    </th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tfoot>
            <td colspan="6">
                <a href="editbooks.php?page=1<?php echo $trozoEnlace ?>">Primero</a>
                <a href="editbooks.php?page=<?php echo max(1, $page - 1) . $trozoEnlace; ?>">Anterior</a>
                <a href="editbooks.php?page=<?php echo min($page + 1, $pages) . $trozoEnlace; ?>">Siguiente</a>
                <a href="editbooks.php?page=<?php echo $pages . $trozoEnlace ?>">Ultimo</a>
            </td>
        </tfoot>
        <tbody>
            <?php foreach ($editoriales as $indice => $editorial) { ?>
                <tr>
                    <td><?php echo $editorial->getIdEditorial() ?></td>
                    <td><?php echo $editorial->getNombre() ?></td>
                    <td><?php echo $editorial->getPais() ?></td>
                    <td>
                        <a class="borrar" href='phpdelete.php?idEditorial=<?php echo $editorial->getIdEditorial() ?>'>Borrar </a>
                        <a href='viewedit.php?idEditorial=<?php echo $editorial->getIdEditorial() ?>'>Editar</a>
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
