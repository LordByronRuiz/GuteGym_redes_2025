<?php
$conexion = new mysqli('localhost','root','','formulario');

if (!$conexion){
    die('Error de conexión'.mysql_error());
}

else {
    echo "Conexión realizada con éxito";
}

$nombre = $_POST['nombre'];
$correo = $_POST['email'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO `contacto`(`nombre`,`correo`,`comentarios`) VALUES ('$nombre','$correo','$mensaje')";

if(mysqli_query($conexion, $sql)){
    $success = "El ingreso ha sido satisfactorio";
    echo $success;
}
else{
    echo "Error de ingreso".mysqli_error($conexion);
}

mysqli_close($conexion);  
?>
