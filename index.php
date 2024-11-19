<!DOCTYPE html>
<html>
<head>
    <title>Usuarios de Administración</title>
    <meta charset="utf-8">
    <meta name="author" content="Grupo 2">
    <link rel="stylesheet" href="css/Pablo.css">
</head>
<body>
    <header>
        <a href="https://fundacionloyola.com/vguadalupe/" target="_blank"><img src="img/logoEVG.png" alt=""></a>
        <nav>
            <a href="">Gestión</a>
            <a href="">Info. Reservas</a>
            <a href="">Validación Solic.</a>
            <a href="">Estadísticas</a>
        </nav>
    </header>
    <main>
        <!-- Mensaje + boton de añadir usuario-->
        <h1>ADMINISTRADOR DE USUARIOS</h1>
        <p class="mensajePablo">Hola, Pilar...</p>
        <button class="botonUsuarioPablo"><a href="nuevosUsuarios.html">AÑADIR NUEVO USUARIO</a></button>
        
        <!-- Lista de usuarios -->
        <ul class="listaPablo">
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

            // Consulta para obtener los usuarios
            $sql = "SELECT nombreAdmin, tipo FROM UsuariosPermisos";
            $resultado = $conexion->query($sql);

            // Verificar si hay resultados
            if ($resultado->num_rows > 0) {
                // Listar los usuarios
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<li class='itemsPablo'>";
                    echo "<div class='usuarioPablo'></div>";
                    echo "<span class='nombrePablo'>" . htmlspecialchars($fila['nombreAdmin']) . " (" . htmlspecialchars($fila['tipo']) . ")</span>";
                    echo "<div class='botonesPablo'>";
                    echo "<div class='emailPablo'></div>";
                    echo "<div class='borrarPablo'></div>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "<li>No hay usuarios registrados.</li>";
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </ul>
    </main>
    <!-- Footer -->
    <footer>
        <p>
            Escuela Virgen de Guadalupe
        </p>
        <p>
            Grupo 2
        </p>
    </footer>
</body>
</html>
