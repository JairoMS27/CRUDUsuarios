<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/

/* Al salir de la sesion borra la sesion y te manda al inicio */
session_start();
session_destroy();
header("Location: index.php");
exit;

?>