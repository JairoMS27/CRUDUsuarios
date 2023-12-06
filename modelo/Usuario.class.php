<?php
/*

    Título: Tarefa 6 - 1 CRUD Usuarios.

    Autor: Jairo.

    Data modificación: 29/11/2023

    Versión 1.0

*/

class Usuario {
    public $codigo; // Código del usuario
    public $usuario; // Nombre de usuario
    public $hashContrasinal; // Contraseña hasheada
    public $email; // Dirección de correo electrónico
    public $rol; // Rol del usuario
    public $imaxe; // Imagen del usuario

    public function crear($usuario, $contrasinal, $email, $rol, $imaxe, $codigo = null) {
        $this->codigo = $codigo; // Asignar el código del usuario
        $this->usuario = $usuario; // Asignar el nombre de usuario
        $this->hashContrasinal = $contrasinal; // Asignar la contraseña hasheada
        $this->email = $email; // Asignar la dirección de correo electrónico
        $this->rol = $rol; // Asignar el rol del usuario
        $this->imaxe = $imaxe; // Asignar la imagen del usuario
    }
}
?> 