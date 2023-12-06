<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/
require_once('./controlador/controlUsuarioClass.php');

session_start();

// Verifica si el método de solicitud es GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Llama a la función destroy del controlador de usuarios y pasa el código como parámetro
    controlUsuario::destroy($_GET['codigo']);
    // Redirecciona al archivo usuarios.php
    header("Location: usuarios.php");
    exit;
}
?>