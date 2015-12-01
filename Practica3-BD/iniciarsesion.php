<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link type="text/css" rel="stylesheet" href="sesion.css">
        <title></title>
    </head>
    <body>
        <form method="post" action="phpbackend.php">
            <label for="user">Usuario</label>
            <input type="text" name="user" id="user"/><br/>
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass"/><br/>
            <input type="submit" value="Login"/>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
