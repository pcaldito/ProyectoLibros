<?php
require_once 'Usuario.php'; // Asegúrate de que la ruta al archivo es correcta

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAdmin'])) {
    $idAdmin = $_POST['idAdmin']; // Obtener el ID del usuario desde el formulario

    // Crear una instancia de la clase Usuario y llamar al método eliminarUsuario
    $usuario = new Usuario();
    $usuario->eliminarUsuario($idAdmin);
} else {
    echo "Solicitud no válida.";
    echo '<a href="../listaUsuarios.php">Volver</a>';
}
?>
