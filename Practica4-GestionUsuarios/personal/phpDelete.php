    <?php
    require '../clases/AutoCarga.php';
    $sesion = new Session();

    $bd = new DataBase();
    $gestor = new ManageUsuario($bd);

    $emailTabla = Request::post("botonBorrar");
    $procedencia = Request::post("paginaAnterior");

    $userDelete = $gestor->delete($emailTabla);

    $sesion->sendRedirect($procedencia . ".php");