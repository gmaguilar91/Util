<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageCategorias($bd);
$idCategorias = Request::get("idCategorias");
$categoria = $gestor->get($idCategorias);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpedit.php">
            Categoria<input type="text" name="idCategorias" value="<?php echo $categoria->getIdCategorias() ?>"/><br/>
            <input type="hidden" name="pkidCategorias" value="<?php echo $categoria->getIdCategorias() ?>" /><br/>
            <input type="submit" name="editar" value="Editar"/>
        </form>
    </body>
</html>
