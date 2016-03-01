<?php

class Controlador {

    function handle() {
        $op = 0;
        if (isset($_GET["op"])) {
           echo  $op = $_GET["op"];
            //$op = Request::get("op);
        }

        $metodo = "metodo" . $op;

        if (method_exists($this, $metodo)) {
            $this->$metodo();
        } else {
            $this->metodo0();
        }
    }
    
    function metodo0() {
        $bd = new DataBase();
        $gestor = new ManageImagen($bd);
        $imagenes = $gestor->getList();
        $contador = 1;
        $codigo_imagenes = "";
        
        $plantilla_imagenes = file_get_contents('_plantillas/_imagen.html');

        foreach ($imagenes as $indice => $imagen) {
            //str_replace("{" . $key . "}", $value, $plantilla_imagenes);
            $elementos_i = str_replace("{id_imagen}", $contador++, $plantilla_imagenes);
            $elementos_i = str_replace("{categoria}", $imagen->getCategoria(), $elementos_i);
            $elementos_i = str_replace("{ruta_imagen}", $imagen->getRuta(), $elementos_i);
            $codigo_imagenes .= $elementos_i;
        }
        
        
        $pagina = file_get_contents('_plantillas/_index.html');

        $filtro = file_get_contents('_plantillas/_filtrado.html');
 
        //$contenido_galeria = file_get_contents('_plantillas/_cuerpo.html');

        $contenido_galeria = file_get_contents('_plantillas/_galeria.html');
        
        $contenido_galeria = str_replace("{imagenes}", $codigo_imagenes, $contenido_galeria);
        
        $datos = array(
            "filtrado" => $filtro,
            "contenido_galeria" => $contenido_galeria
        );

        foreach ($datos as $key => $value) {
            $pagina = str_replace("{" . $key . "}", $value, $pagina);
        }

        echo $pagina;
    }
}
