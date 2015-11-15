<?php
require 'clases/AutoCarga.php';
$sesion = new Session();
$ruta = $sesion->get("ruta");

if (is_dir($ruta)) {
    if ($dh = opendir($ruta)) {
        ?>
        <html>
            <head></head>
            <body>
                <h1>Bienvenido a su carpeta, <?php echo $sesion->get("numSocial"); ?></h1>
                <ul>
                    <?php
                    while (($file = readdir($dh)) !== false) {
                        if (!is_dir($ruta . $file)) {
                            //esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio 
                            //mostraría tanto archivos como directorios 
                            $linkPre = "C:/Apache24/userSas/" . $sesion->get("numSocial") . "/" . $file;
                            ?>
                    <li><a href="<?php echo readfile($link."/".$file); ?>"><?php echo $file; ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php
            }
        }
        ?>
        <h3>Se han subido <?php echo $sesion->get("correctas"); ?> archivos de <?php echo $sesion->get("numArchivos"); ?></h3>
        <h3>La subida de <?php echo $sesion->get("fallos"); ?> archivos ha fallado</h3>
    </body>    
</html>
<?php
$sesion->destroy();
