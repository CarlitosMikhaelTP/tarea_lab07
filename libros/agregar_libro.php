<?php

include('../conexion/conexion.php');

// Obtenemos los valores del formulario
$anio = $_POST['anio'];
$autor = $_POST['autor'];
$titulo = $_POST['titulo'];
$ubicacion = $_POST['ubicacion'];
$especialidad = $_POST['especialidad'];
$editorial = $_POST['editorial'];

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consulta a la base de datos
$query = $conexion->prepare("INSERT INTO libro (anio, autor, titulo, ubicacion, especialidad, editorial ) VALUES (?, ?, ?, ?, ?, ?)");
$query->bind_param('ssssss', $anio, $autor, $titulo, $ubicacion, $especialidad, $editorial);
$msg = '';
if ($query->execute()) {
    $msg = 'Autor registrado';
}
else {
    $msg = 'No se pudo registrar el libro';
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
    <title>Editar Libro</title>
</head>
<body>
    <h1>Editar Libro</h1>
    <h3><?php echo $msg ?></h3>
    <a href="libros.php">Regresar</a>
</body>
</html>