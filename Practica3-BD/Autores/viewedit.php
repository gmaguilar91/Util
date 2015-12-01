<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageAutores($bd);
$idAutores = Request::get("idAutores");
$autor = $gestor->get($idAutores);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpedit.php">
            Autores<input type="text" name="idAutores" value="<?php echo $autor->getIdAutores(); ?>" /><br/>
            Nombre<input type="text" name="nombre" value="<?php echo $autor->getNombre(); ?>" /><br/>
            Apellidos<input type="text" name="apellidos" value="<?php echo $autor->getApellidos(); ?>"/><br/>
            Nacionalidad<input type="text" name="nacionalidad" value="<?php echo $autor->getNacionalidad(); ?>"/><br/>
            <input type="hidden" name="pkidAutores" value="<?php echo $autor->getIdAutores() ?>" /><br/>
            <input type="submit" name="editar" value="Editar"/>
        </form>
    </body>
</html>