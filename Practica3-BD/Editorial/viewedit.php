<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageEditorial($bd);
$idEditorial = Request::get("idEditorial");
$editorial = $gestor->get($idEditorial);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpedit.php">
            Editorial<input type="text" name="idEditorial" value="<?php echo $editorial->getIdEditorial(); ?>" /><br/>
            Nombre<input type="text" name="nombre" value="<?php echo $editorial->getNombre(); ?>" /><br/>
            Pais<input type="text" name="pais" value="<?php echo $editorial->getPais(); ?>"/><br/>
            <input type="hidden" name="pkidEditorial" value="<?php echo $editorial->getIdEditorial() ?>" /><br/>
            <input type="submit" name="editar" value="Editar"/>
        </form>
    </body>
</html>