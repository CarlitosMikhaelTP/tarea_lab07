<?php

include('../conexion/conexion.php');

// Obtenemos los valores del formulario
$nombres = $_POST['nombre'];
$ape_paterno = $_POST['ap_paterno'];
$ape_materno = $_POST['ap_materno'];

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consulta a la base de datos
$query = $conexion->prepare("INSERT INTO autor (nombre, ap_paterno, ap_materno) VALUES (?, ?, ?)");
$query->bind_param('sss', $nombres, $ape_paterno, $ape_materno);
$msg = '';
if ($query->execute()) {
    $msg = 'Autor registrado';
}
else {
    $msg = 'No se pudo registrar al autor';
}

// Cerramos la conexión a la base de datos
desconectar($conexion);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar autor</title>
</head>
<body>
    <h1>Editar Autor</h1>
    <h3><?php echo $msg ?></h3>
    <a href="autores.php">Regresar</a>
</body>
</html>