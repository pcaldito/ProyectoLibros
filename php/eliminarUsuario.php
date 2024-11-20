<?php
    // Conexión a la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $contrasenia = "";
    $basedeDatos = "proyectoreservas";

    // Crear conexión
    $conexion = new mysqli($servidor, $usuario, $contrasenia, $basedeDatos);

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Procesar solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAdmin'])) {
        $idAdmin = intval($_POST['idAdmin']); // Convertir a entero por seguridad

        // Preparar la consulta de eliminación
        $sql = "DELETE FROM UsuariosPermisos WHERE idAdmin = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idAdmin);

        if ($stmt->execute()) {
            echo "Usuario eliminado exitosamente.";
        } else {
            echo "Error al eliminar el usuario: " . $conexion->error;
        }
        echo '<a href=../index.html>Volver</a>';

        $stmt->close();
    }

    // Cerrar conexión
    $conexion->close();

    // Redirigir de vuelta a la página de usuarios
    header("Location: ../listaUsuarios.php");
    exit;
?>
