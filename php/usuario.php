<?php
class Usuario {
    private $conexion;

    // Método para crear la conexión
    public function conexion() {
        $servidor = "localhost";
        $usuario = "root";
        $contrasenia = "";
        $basedeDatos = "librosreservas";
        
        $this->conexion = new mysqli($servidor, $usuario, $contrasenia, $basedeDatos);

        // Verificar la conexión
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function comprobarInfoFormulario() {
        // Inicializamos las variables
        $nombre = $usuario = $correo = $tipo = $contrasenia = "";

        // Validamos cada campo individualmente
        if (empty($_POST['nombre'])) {
            echo 'Falta el nombre<br>';
        } else {
            $nombre = $_POST['nombre'];
        }

        if (empty($_POST['usuario'])) {
            echo 'Falta el usuario<br>';
        } else {
            $usuario = $_POST['usuario'];
        }

        if (empty($_POST['correo'])) {
            echo 'Falta el correo<br>';
        } else {
            $correo = $_POST['correo'];
        }

        if (empty($_POST['tipo'])) {
            echo 'Falta el tipo de usuario<br>';
        } else {
            $tipo = $_POST['tipo'];
        }

        if (empty($_POST['contrasenia'])) {
            echo 'Falta crear una contraseña<br>';
        } else {
            $contrasenia = $_POST['contrasenia'];
        }

        // Mostramos la información si todos los campos están completos
        if ($nombre && $usuario && $correo && $tipo && $contrasenia) {
            echo "Nombre: $nombre<br>";
            echo "Usuario: $usuario<br>";
            echo "Correo: $correo<br>";
            echo "Tipo: $tipo<br>";
            echo "Contraseña: $contrasenia<br>";
        }

        $this->insertarUsuario($usuario,$contrasenia,$tipo);

    }

    public function insertarUsuario($usuario, $contrasenia, $tipo) {
        $sql = "INSERT INTO UsuariosPermisos (nombreAdmin, contrasenia, tipo) 
        VALUES ('$usuario', '$contrasenia', '$tipo')";

        // Ejecutamos la consulta y verificamos el resultado
        if ($this->conexion->query($sql) === TRUE) {
            echo "Registro insertado correctamente.<br>";
        } else {
            echo "Error al insertar el registro: " . $this->conexion->error . "<br>";
        } 
    }
}
?>
