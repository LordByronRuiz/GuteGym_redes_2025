<?php
$conexion = new mysqli("localhost", "root", "", "gute_gym");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $conexion->real_escape_string($_POST["nombre"]);
    $ejercicios = $conexion->real_escape_string($_POST["ejercicios"]);

    $sql = "INSERT INTO rutinas (nombre, ejercicios) VALUES ('$nombre', '$ejercicios')";

    if ($conexion->query($sql) === TRUE) {
        echo "Rutina guardada en la base de datos.";
    } else {
        echo "Error: " . $conexion->error;
    }
} else {
    echo "Método no permitido.";
}

$conexion->close();
?>
