<html>
    <head>
        <meta charset="UTF-8">
        <title>Suba sus archivos</title>
        <link rel="stylesheet" type="text/css" href="styleSubir.css" />
    </head>
    <body>
        <div id="contenedor">
            <?php
            require 'clases/AutoCarga.php';
            $sesion = new Session();
            $usuario = $sesion->getUser();

            echo "<h1>Bienvenido " . $usuario . "</h1>";
            echo "<hr>";
            ?>
            <form method="post" action="phpSubir.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td><label>Seleccione una cancion</label></td>
                        <td><input type="file" name="archivos" required/></td>
                    </tr>
                    <tr>
                        <td><label>Categoria</label></td>
                        <td><select name="categoria">
                                <option>Clasica</option>
                                <option>Pop</option>
                                <option>Rock</option>
                                <option>Rap</option>
                            </select></td>
                    </tr>
                    <td><input type="submit" name="anadir" value="Agregar"/></td>
                </table>
            </form>
            <hr>
            <?php
            $rock = 0;
            $clasica = 0;
            $rap = 0;
            $pop = 0;
            $sesion = new Session();
            $ruta = "./users/" . $sesion->getUser();
            if (is_dir($ruta)) {
                if ($dh = opendir($ruta)) {
                    echo "<ul>";
                    while (($file = readdir($dh)) !== false) {
                        if (!is_dir($ruta . $file)) {
                            if (strpos($file, "Rock")) {
                                $rock++;
                            } else if (strpos($file, "Clasica")) {
                                $clasica++;
                            } else if (strpos($file, "Pop")) {
                                $pop++;
                            } else {
                                $rap++;
                            }
                            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
                            //mostraría tanto archivos como directorios 
                            echo "<li>" . $file . "</li>";
                            $link = $ruta . "/" . $file;
                            echo "<audio controls><source src = " . $link . " type = 'audio/mpeg'>
                        </audio>";
                        }
                    }
                    echo "</ul>";
                    echo "<div id='listaCanciones'><span>";
                    echo $sesion->getUser() . ", estas son sus canciones: ";
                    echo "</span><ul>"
                    . "<li>".$rock." cancion(es) rock</li>"
                    . "<li>".$pop." cancion(es) pop</li>"
                    . "<li>".$clasica." cancion(es) clasicas</li>"
                    . "<li>".$rap." cancion(es) rap</li>"
                    . "</ul></div>";
                    closedir($dh);
                }
            }
            ?>
            <div id="logout">
                <form method="post" action="logout.php">
                    <input type="submit" name="logout" value="Logout"/>
                </form>
            </div>
        </div>
    </body>
</html>
