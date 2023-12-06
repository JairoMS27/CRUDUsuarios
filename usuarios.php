<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/
require_once("./modelo/Dao.class.php");
require_once('./modelo/Usuario.class.php');
require_once('./controlador/controlUsuarioClass.php');

session_start();

// Comprobacion de admin
if (!controlUsuario::isAdmin()) {
    header("Location: ./forbidden.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vista/css/style.css">
    <script
      src="https://kit.fontawesome.com/28acf2ca7d.js"
      crossorigin="anonymous"
    ></script>
    <title>Usuarios</title>
</head>

<body class="usuarios">
    <?php
    include "menu.php";
    ?>
    <a href="detalleUsuario.php">
    <button class="icon-btn add-btn">
    <div class="add-icon"></div>
    <div class="btn-txt">Añadir Usuario</div>
    </button>
    </a>
    <table>
    <tr>
        <th>Código</th>
        <th>Usuario</th>
        <th>Email</th>
        <th>Contrasinal</th>
        <th>Rol</th>
        <th>Imaxe</th>
        <th>Accións</th>
    </tr>
    <?php 
        // Muestra los usuarios 
        $usuarios = controlUsuario::index(); // usa el metodo para obtener los usuarios
        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario->codigo . '</td>';
            echo '<td>' . $usuario->usuario . '</td>';
            echo '<td>' . $usuario->email . '</td>';
            echo '<td>' . $usuario->hashContrasinal . '</td>';
            echo '<td>' . $usuario->rol . '</td>';
            echo '<td>' . $usuario->imaxe . '</td>';
            echo '<td class="actions"><a class="enlace-crud" href="borrar.php?codigo=' . $usuario->codigo . '"><i class="fa-solid fa-user-xmark"></i></a></td>';
            echo '<td class="actions"><a class="enlace-crud" href="detalleUsuario.php?codigo=' . $usuario->codigo . '"><i class="fa-solid fa-user-edit"></i></a></td>';
            echo '</tr>';
        }
    ?>
</table>

</body>
</html>