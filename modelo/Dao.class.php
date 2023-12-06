<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/
require_once("./modelo/Usuario.class.php");

class DAO {
    private static $pdo;    

    // creacion del metodo conectar
    public static function conectar() {
        self::$pdo = new PDO("mysql:host=localhost;dbname=miniaplicacion", "phpmyadmin", "1234");
        self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // creacion del metodo ler
    public static function lerUsuarios() {
        try {
            $stmt = self::$pdo->prepare("SELECT * FROM usuario");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, "Usuario");
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // creacion del metodo para obtener un usuario
    public static function obterUsuario($codigoUsuario) {
        try {
            $stmt = self::$pdo->prepare("SELECT * FROM usuario WHERE codigo = :codigo");
            $stmt->bindParam(":codigo", $codigoUsuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, "Usuario")[0];
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // creacion del metodo para borrar usuario
    public static function borrar($codigoUsuario) {
        try {
            $stmt = self::$pdo->prepare("DELETE FROM usuario WHERE codigo = :codigo");
            $stmt->bindParam(":codigo", $codigoUsuario);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // creacion del metodo para almacenar un usuario
    public static function gardarUsuario($usuario) {
        try {
            $stmt = self::$pdo->prepare("INSERT INTO usuario (usuario, hashContrasinal, email, rol, imaxe) VALUES (:usuario, :hashContrasinal, :email, :rol, :imaxe)");
            $stmt->bindParam(":usuario", $usuario->usuario);
            $stmt->bindParam(":hashContrasinal", $usuario->hashContrasinal);
            $stmt->bindParam(":email", $usuario->email);
            $stmt->bindParam(":rol", $usuario->rol);
            $stmt->bindParam(":imaxe", $usuario->imaxe);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // creacion de metodo para modificar el usuario
    public static function modificarUsuario($usuario, $taboa) {
        try {
            $stmt = self::$pdo->prepare("UPDATE $taboa SET usuario = :usuario, email = :email WHERE codigo = :codigo");
            $stmt->bindParam(":usuario", $usuario->usuario);
            $stmt->bindParam(":email", $usuario->email);
            $stmt->bindParam(":codigo", $usuario->codigo);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // creacion de metodo para obterner el usuario por email
    public static function obterUsuarioPorEmail($email) {
        try {
            $stmt = self::$pdo->prepare("SELECT * FROM usuario WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                return null;
            }
            return $stmt->fetchAll(PDO::FETCH_CLASS, "Usuario")[0];
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>