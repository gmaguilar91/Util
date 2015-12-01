<?php

require 'clases/Autocarga.php';

$user = Request::post("user");
$pass = Request::post("pass");
$sesion = new Session();


if ($user === "admin" && $pass === "12345") {
    $sesion->set("user", $user);
    $sesion->set("pass", $pass);
    header("Location:backend.php");
} else {
    header("Location:index.php");
}
