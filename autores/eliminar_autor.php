<?php

include('../conexion/conexion.php');

// Obtenemos el id del autor a eliminar
$id_autor = $_GET['id_autor'];

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consulta a la base de datos
$query = $conexion->prepare("DELETE FROM autor WHERE autor_id = ?");
$query->bind_param('i', $id_autor);

$msg = '';
if ($query->execute()) {
    $msg = 'Autor eliminado';
}
else {
    $msg = 'No se pudo eliminar al autor';
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
    <title>Eliminaste a un autor</title>
</head>
<body>
    <h1>Eliminar Autor</h1>
    <h3><?php echo $msg ?></h3>
    <a href="autores.php">Regresar</a>
</body>
</html>