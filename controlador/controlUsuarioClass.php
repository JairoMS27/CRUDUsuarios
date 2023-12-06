<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/
require_once("./modelo/Dao.class.php");

class controlUsuario {
    
    // Método para mostrar todos los usuarios
    public static function index() {
        DAO::conectar();
        $usuarios = DAO::lerUsuarios();
        return $usuarios;
    }

    // Método para mostrar un usuario específico
    public static function show($idUsuario) {
        if (controlUsuario::isAdmin()) {
            DAO::conectar();
            $usuario = DAO::obterUsuario($idUsuario);
            if (!$usuario) {
                header("Location: ./error.php");
                exit();
            }
            return $usuario;
        } else {
            header("Location: ./forbidden.php");
            exit();
        }
    }

    // Método para eliminar un usuario
    public static function destroy($idUsuario) {
        if (controlUsuario::isAdmin()) {
            DAO::conectar();
            $usuario = DAO::obterUsuario($idUsuario);
            if (!$usuario) {
                header("Location: ./error.php");
                exit();
            }
            return DAO::borrar($idUsuario);
        } else {
            header("Location: ./forbidden.php");
            exit;
        }
    }

    // Método para crear un nuevo usuario
    public static function create($usuario) {
        if (controlUsuario::isAdmin()) {
            DAO::conectar();
            return DAO::gardarUsuario($usuario);
        } else {
            header("Location: ./forbidden.php");
            exit;
        }
    }

    // Método para actualizar un usuario existente
    public static function update($usuario) {
        if (controlUsuario::isAdmin()) {
            DAO::conectar();
            $usuarioExistente = DAO::obterUsuario($usuario->id);
            if (!$usuarioExistente) {
                header("Location: ./error.php");
                exit();
            }
            return DAO::modificarUsuario($usuario, "usuario");
        } else {
            header("Location: ./forbidden.php");
            exit;
        }
    }

    // Método para iniciar sesión
    public static function login($email, $contrasinal) {
        DAO::conectar();
        $usuario = DAO::obterUsuarioPorEmail($email);
        if (isset($usuario)) {
            return password_verify($contrasinal, $usuario->hashContrasinal);
        }
        return false;
    }

    // Método para comprobar si el usuario es administrador
    public static function isAdmin() {
        $email = $_SESSION['email'];
        DAO::conectar();
        $usuario = DAO::obterUsuarioPorEmail($email);
        return $usuario->rol == "admin";
    }

       // Método para procesar el formulario de creación o actualización de usuario
       public static function processForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['codigo'])) {
                $usuario = new Usuario();
                $usuario->crear($_POST['usuario'], null, $_POST['email'], $_POST['rol'], $_POST['imaxe'], $_POST['codigo']);
                controlUsuario::update($usuario);
            } else {
                if (isset($_FILES["imaxe"]) && $_FILES["imaxe"]["error"] == 0) {
        
                    $nomeTemporal = $_FILES["imaxe"]["tmp_name"];
                    $nomeArquivo = $_POST['email'];
                
                    // Mover el archivo temporal a una ubicación específica
                    $destino = "arquivos/" . $nomeArquivo . ".jpeg";
                
                    if (move_uploaded_file($nomeTemporal, $destino)) {
                      echo "El archivo se cargó correctamente.";
                    } else {
                      echo "Hubo un error al cargar el archivo.";
                    }
                } else {
                    // Comprobar si existe una foto de perfil para el animal
                    echo "Por favor elija un archivo válido";
                } 
                $hashContrasinal = password_hash($_POST['contrasinal'], PASSWORD_DEFAULT);
                $usuario = new Usuario();
                $usuario->crear($_POST['usuario'], $hashContrasinal, $_POST['email'], $_POST['rol'], $destino);
                controlUsuario::create($usuario);
                
            }
            header("Location: usuarios.php");
            exit;
        }
    }
}
?>