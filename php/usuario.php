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

    // Validación de datos del formulario y registro de un nuevo usuario
    public function comprobarInfoFormulario() {
        $nombre = $usuario = $correo = $tipo = $contrasenia = "";

        if (empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['correo']) || empty($_POST['tipo']) || empty($_POST['contrasenia'])) {
            echo 'Faltan datos obligatorios. <br>';
            echo '<a href="../nuevosUsuarios.html">Volver</a>';
            return;
        }

        $nombre = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $tipo = $_POST['tipo'];
        $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT);

        $this->conexion();
        $this->insertarUsuario($nombre, $contrasenia, $tipo);
        $this->conexion->close();
    }

    // Método para insertar un usuario en la base de datos
    private function insertarUsuario($nombre, $contrasenia, $tipo) {
        $sql = "INSERT INTO UsuariosPermisos (nombreAdmin, contrasenia, tipo) 
                VALUES (?, ?, ?)";
    
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss", $nombre, $contrasenia, $tipo);
    
        if ($stmt->execute()) {
            // Registro insertado correctamente, redirigir
            $stmt->close();
            $this->conexion->close();
            header("Location: ../listaUsuarios.php");
            exit(); // Detener el script tras la redirección
        } else {
            echo "Error al insertar el registro: " . $this->conexion->error . "<br>";
        }
    
        $stmt->close();
        $this->conexion->close();
    }
    

    // Método para eliminar un usuario de la base de datos
    public function eliminarUsuario($idAdmin) {
        $this->conexion();
    
        // Validamos que el idAdmin sea un número entero
        $idAdmin = intval($idAdmin);
        if ($idAdmin <= 0) {
            echo "ID inválido.";
            return;
        }
    
        // Preparamos la consulta para eliminar el usuario
        $sql = "DELETE FROM UsuariosPermisos WHERE idAdmin = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idAdmin);
    
        if ($stmt->execute()) {
            $stmt->close();
            $this->conexion->close();
            header("Location: ../listaUsuarios.php");
            exit();
        } else {
            echo "Error al eliminar el usuario: " . $this->conexion->error . "<br>";
        }
    
        $stmt->close();
        $this->conexion->close();
    }
    
}
?>
