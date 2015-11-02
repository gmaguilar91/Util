<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Podcast</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <img src="podcast.jpg"/>
        <form method="post" action="phpIngresar.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label>User: </label></td>
                    <td><input type="text" name="usuario" placeholder="Insert user" required/></td>
                </tr>
                <tr>
                    <td><label>Password: </label></td>
                    <td><input type="password" name="contrasena" placeholder="Insert password" required/></td>
                </tr>
                <td><input type="submit"/></td>
            </table>
        </form>
    </body>
</html>
