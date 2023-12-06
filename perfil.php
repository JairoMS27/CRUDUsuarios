<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/

session_start();

/* Verifica que tengas la sesion iniciada */
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vista/css/style.css">
    <title>Perfil | PlayDate</title>
</head>

<body class="perfil">
    <?php
    include "menu.php";
    ?>
    <div class="foto-perfil">
        <fieldset>
            <legend>Foto de perfil</legend>
            <?php
            // Comprobar se se cargou un arquivo
            if (isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == 0) {

                $nomeTemporal = $_FILES["arquivo"]["tmp_name"];
                $nomeArquivo = $_FILES["arquivo"]["name"];

                // Mover o arquivo temporal a unha ubicacion concreta
                $destino = "arquivos/" . $_SESSION["email"] . ".jpeg";

                if (move_uploaded_file($nomeTemporal, $destino)) {
                    echo "O arquivo cargouse correctamente.";
                } else {
                    echo "Houbo un erro ao cargar o arquivo.";
                }
            } else {
                // Comprobar se existe unha foto de perfil para o usuario
                $fotoPerfil = "arquivos/" . $_SESSION["email"] . ".jpeg";
                if (file_exists($fotoPerfil)) {
                    $fotoPerfil = "arquivos/" . $_SESSION["email"] . ".jpeg";
                } else {
                    // Se non existe, poñer unha foto por defecto
                    $fotoPerfil = "arquivos/default.jpeg";
                }
            }
            ?>
            <form action="perfil.php" method="post" enctype="multipart/form-data">
                <label for="arquivo">Escolle un arquivo:</label>
                <input type="file" name="arquivo" id="arquivo"><br>
                <input type="submit" value="Cargar Arquivo"><br>
                <img alt="Foto de Perfil" width="128" height="128" src="<?php echo $fotoPerfil;  ?>">
            </form>

        </fieldset>
    </div>
    <div class="control-de-acceso">
        <h1>Últimos accesos</h1>
        <ul>
            <?php
            foreach ($listaAccesos as $acceso) {
                echo '<li>' . $acceso . '</li>';
            }
            ?>
    </div>
</body>

</html>