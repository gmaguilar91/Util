<?php
require '../clases/AutoCarga.php';

$bd = new DataBase();
$gestor = new ManageAutores($bd);
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

$autores = $gestor->getList($page, trim($orden));
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
        <h1>Estos son sus autores,  <?php echo $sesion->get("user") ?></h1>
        <?php
        if ($op != null) {
            echo "<h2>La operacion $op ha dado como resultado $r.</h2>";
        }
        ?>
        <nav>
            <a href="../Libros/books.php">Libros</a>
            <a href="writers.php">Autores</a>
            <a href="../Editorial/editbooks.php">Editoriales</a>
            <a href="../Generos/genders.php">Generos</a>
            <a href="../Categorias/categories.php">Categorias</a>
        </nav>
        <br/>
        <a href="viewinsert.php">Agregar autor</a>
        <table border="1">
            <thead>
                <tr>
                    <th>Código 
                        <a href="?order=idAutores&sort=desc">&Del;</a>
                        <a href="?order=idAutores&sort=asc">&Delta;</a>
                    </th>
                    <th>Nombre
                        <a href="?order=nombre&sort=desc">&Del;</a>
                        <a href="?order=nombre&sort=asc">&Delta;</a></th>
                    <th>Apellidos
                        <a href="?order=apellidos&sort=desc">&Del;</a>
                        <a href="?order=apellidos&sort=asc">&Delta;</a>
                    </th>
                    <th>Nacionalidad
                        <a href="?order=nacionalidad&sort=desc">&Del;</a>
                        <a href="?order=nacionalidad&sort=asc">&Delta;</a>
                    </th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tfoot>
            <td colspan="6">
                <a href="writers.php?page=1<?php echo $trozoEnlace ?>">Primero</a>
                <a href="writers.php?page=<?php echo max(1, $page - 1) . $trozoEnlace; ?>">Anterior</a>
                <a href="writers.php?page=<?php echo min($page + 1, $pages) . $trozoEnlace; ?>">Siguiente</a>
                <a href="writers.php?page=<?php echo $pages . $trozoEnlace ?>">Ultimo</a>
            </td>
        </tfoot>
        <tbody>
            <?php foreach ($autores as $indice => $autor) { ?>
                <tr>
                    <td><?php echo $autor->getIdAutores() ?></td>
                    <td><?php echo $autor->getNombre() ?></td>
                    <td><?php echo $autor->getApellidos() ?></td>
                    <td><?php echo $autor->getNacionalidad() ?></td>
                    <td>
                        <a class="borrar" href='phpdelete.php?idAutores=<?php echo $autor->getIdAutores() ?>'>Borrar </a>
                        <a href='viewedit.php?idAutores=<?php echo $autor->getIdAutores() ?>'>Editar</a>
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
