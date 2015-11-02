<?php
require 'clases/AutoCarga.php';

 $users = array(
     "Juan" => "abc",
     "Pepe" => "ghi",
     "Elena" => "123",
     "Lucia" => "456"
 );
 
 $user = Request::post("usuario");
 $password = Request::post("contrasena");
 $sesion = new Session();
 
 if(isset($users[$user])&& $users[$user]==$password){
     $usuario = new Usuario($user);
     $sesion->setUser($usuario);
     $sesion->sendRedirect("subirFile.php");
 }else{
     $sesion->destroy();
     $sesion->sendRedirect("index.php");
 }
 
