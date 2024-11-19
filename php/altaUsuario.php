<?php
    // Incluye la clase base
    include 'usuario.php';

    // Crear una instancia de la clase
    $clase = new Usuario();

    // Llama al método de conexión
    $clase->conexion();

    // Llama al método mostrar para procesar el login
    $clase->comprobarInfoFormulario();

    //Insertar los datos en la tabla UsuariosPermisos
    //$clase->insertarUsuario();
?>