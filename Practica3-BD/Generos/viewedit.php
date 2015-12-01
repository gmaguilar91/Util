<?php
require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageGeneros($bd);
$idGeneros = Request::get("idGeneros");
$genero = $gestor->get($idGeneros);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" action="phpedit.php">
            Genero<input type="text" name="idGeneros" value="<?php echo $genero->getIdGeneros() ?>"/><br/>
            <input type="hidden" name="pkidGeneros" value="<?php echo $genero->getIdGeneros()?>" /><br/>
            <input type="submit" name="editar" value="Editar"/>
        </form>
    </body>
</html>
