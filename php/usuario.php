<?php
class Usuario {
    private $conexion;

    // Método para crear la conexión
    public function conexion() {
        $servidor = "localhost";
        $usuario = "root";
        $contrasenia = "";
        $basedeDatos = "proyectoreservas";
        
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
            echo '<a href=../nuevosUsuarios.html>Volver</a>';
        } else {
            $nombre = $_POST['nombre'];
        }

        if (empty($_POST['usuario'])) {
            echo 'Falta el usuario<br>';
            echo '<a href=../nuevosUsuarios.html>Volver</a>';
        } else {
            $usuario = $_POST['usuario'];
        }

        if (empty($_POST['correo'])) {
            echo 'Falta el correo<br>';
            echo '<a href=../nuevosUsuarios.html>Volver</a>';
        } else {
            $correo = $_POST['correo'];
        }

        if (empty($_POST['tipo'])) {
            echo 'Falta el tipo de usuario<br>';
            echo '<a href=../nuevosUsuarios.html>Volver</a>';
        } else {
            $tipo = $_POST['tipo'];
        }

        if (empty($_POST['contrasenia'])) {
            echo 'Falta crear una contraseña<br>';
            echo '<a href=../nuevosUsuarios.html>Volver</a>';
        } else {
            $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT);
        }

        // Si todos los datos están completos, llamamos a la función para insertar
        if ($nombre && $usuario && $correo && $tipo && $contrasenia) {
            $this->conexion(); // Llamamos al método para conectar con la base de datos
            $this->insertarUsuario($nombre, $contrasenia, $tipo); // Insertamos los datos
            $this->conexion->close(); // Cerramos la conexión
        }
    }

    // Método para insertar los datos en la base de datos
    private function insertarUsuario($nombre, $contrasenia, $tipo) {
        // Consulta SQL para insertar los datos (sin escapado)
        $sql = "INSERT INTO UsuariosPermisos (nombreAdmin, contrasenia, tipo) 
                VALUES ('$nombre', '$contrasenia', '$tipo')";

        // Ejecutamos la consulta y verificamos el resultado
        if ($this->conexion->query($sql) === TRUE) {
            echo "Registro insertado correctamente.<br>";
        } else {
            echo "Error al insertar el registro: " . $this->conexion->error . "<br>";
        }

        echo '<a href=../index.php>Volver</a>';
    }
}
?>
