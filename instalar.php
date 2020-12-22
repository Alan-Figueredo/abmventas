<?php 
    include_once "config.php";
    include_once "entidades/usuario.php";
    $usuario = new Usuario();
    $usuario->usuario;
    $usuario->clave;
    $usuario->nombre; 
    $usuario->apellido;
    $usuario->correo; 
    $usuario->insertar();
?>