<?php
    require_once 'Usuario.php'; 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idAdmin'])) {
        $idAdmin = $_POST['idAdmin']; 
        $usuario = new Usuario();
        $usuario->eliminarUsuario($idAdmin);
    } else {
        echo "Solicitud no válida.";
        echo '<a href="../listaUsuarios.php">Volver</a>';
    }
?>
