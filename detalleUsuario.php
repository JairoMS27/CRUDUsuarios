<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/
require_once('./controlador/controlUsuarioClass.php');
require_once('./modelo/Usuario.class.php');
require_once('./modelo/Dao.class.php');

session_start();

// Verificar si el usuario no es un administrador y redirigirlo a la página de acceso denegado
if (!controlUsuario::isAdmin()) {
    header("Location: ./forbidden.php");
    exit;
}

// Verificar si el método de solicitud es GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Verificar si se ha proporcionado un parámetro 'codigo' en la URL
    if(isset($_GET['codigo'])){
       // Obtener los detalles del usuario utilizando el método 'show' de la clase 'controlUsuario'
       $usuario = controlUsuario::show($_GET['codigo']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    controlUsuario::processForm();
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vista/css/style.css">
    <title>Document</title>
</head>
<body>
<legend><h1>Crear usuario</h1></legend>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <fieldset>
        <?php if (isset($usuario)) { ?>
        <label for="codigo">ID</label><br>
        <input class="input" type="text" name="codigo" id="codigo" readonly <?php if (isset($usuario)) { ?> value="<?php echo $usuario->codigo ?>" <?php } ?>><br>
        <?php } ?>
        <label for="usuario">Nombre</label><br>
        <input class="input" type="text" name="usuario" id="usuario" <?php if (isset($usuario)) { ?> value="<?php echo $usuario->usuario ?>" <?php } ?>><br>
        <label for="email">Correo</label><br>
        <input class="input" type="email" name="email" id="email" <?php if (isset($usuario)) { ?> value="<?php echo $usuario->email ?>" <?php } ?>><br>
        <?php if (!isset($usuario)) { ?>
        <label for="contrasinal">Contraseña</label><br>
        <input class="input" type="password" name="contrasinal" id="contrasinal"><br>
        <?php } ?>
        <?php if (!isset($usuario)) { ?>
        <label for="imaxe">Imaxe</label><br>
        <input class="input" type="file" name="imaxe" id="imaxe"><br>
        <?php } ?>
        <select name="rol" id="rol"><br>
            <option value="admin" <?php if (isset($usuario) && $usuario->rol == 'admin') { echo "selected"; } ?> >Admin</option>
            <option value="usuario" <?php if (isset($usuario) && $usuario->rol == 'usuario') { echo "selected"; } ?> >Usuario</option>
        </select>
        </fieldset>
        <?php if (isset($usuario)) { ?>
        <button type="submit">Modificar</button>
        <?php } else { ?>
        <button type="submit">Crear</button>
        <?php } ?>
        <a href="./usuarios.php"><button type="button">Cancelar</button></a>
    </form>
</body>
</html>