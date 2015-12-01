<?php

require '../clases/AutoCarga.php';
$bd = new DataBase();
$gestor = new ManageLibros($bd);
$isbn = Request::get("isbn");
$r = $gestor->delete($isbn);

header("Location:books.php?op=delete&r=$r");
