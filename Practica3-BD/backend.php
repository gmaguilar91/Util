<?php
require 'clases/AutoCarga.php';
$bd = new DataBase();
$sesion = new Session();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="estilo.css">
        <title>Biblioteca</title>
    </head>
    <body>
        <h1>Bienvenido <?php echo $sesion->get("user") ?></h1>
        <nav>
            <a href="Libros/books.php">Libros</a>
            <a href="Autores/writers.php">Autores</a>
            <a href="Editorial/editbooks.php">Editoriales</a>
            <a href="Generos/genders.php">Generos</a>
            <a href="Categorias/categories.php">Categorias</a>
        </nav>
        <br/>
        <form action="desconexion.php" method="post">
            <input type="submit" value="Logout"/>
        </form>
        <script src="../js/script.js"></script>
    </body>
</html>