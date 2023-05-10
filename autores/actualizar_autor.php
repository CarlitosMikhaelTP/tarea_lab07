<?php

include('../conexion/conexion.php');

// Verificamos si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtenemos los valores del formulario
    $id_autor = $_POST['autor_id'];
    $nombres = $_POST['nombre'];
    $ape_paterno = $_POST['ap_paterno'];
    $ape_materno = $_POST['ap_materno'];

    // Abrimos la conexión a la base de datos
    $conexion = conectar();

    // Consulta a la base de datos
    $query = $conexion->prepare("UPDATE autor SET nombre = ?, ap_paterno = ?, ap_materno = ? WHERE autor_id = ?");
    $query->bind_param('sssi', $nombres, $ape_paterno, $ape_materno, $id_autor);

    $msg = '';
    if ($query->execute()) {
        $msg = 'Autor actualizado';
    } else {
        $msg = 'No se pudo actualizar al autor';
    }

    // Cerramos la conexión a la base de datos
    desconectar($conexion);

} else {

    // Obtenemos el ID del autor a editar
    $id_autor = $_GET['id_autor'];

    // Abrimos la conexión a la base de datos
    $conexion = conectar();

    // Consulta a la base de datos
    $query = $conexion->prepare("SELECT autor_id, nombre, ap_paterno, ap_materno FROM autor WHERE autor_id = ?");
    $query->bind_param('i', $id_autor);

    if (!$query->execute()) {
        die('Error en la consulta: ' . $conexion->error);
    }

    $resultado = $query->get_result();

    // Obtenemos los datos del autor a editar
    $autor = $resultado->fetch_assoc();

    // Cerramos la conexión a la base de datos
    desconectar($conexion);

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualiza el usuario</title>
</head>
<body>
    <h1>Actualizar el Autor</h1>
    <h3><?php echo isset($msg) ? $msg : '' ?></h3>
    <form method="POST">
        <input type="hidden" name="autor_id" value="<?php echo $autor['autor_id'] ?>">
        <label for="nombre">Nombres:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $autor['nombre'] ?>"><br>
        <label for="ap_paterno">Apellido Paterno:</label>
        <input type="text" name="ap_paterno" id="ap_paterno" value="<?php echo $autor['ap_paterno'] ?>"><br>
        <label for="ap_materno">Apellido Materno:</label>
        <input type="text" name="ap_materno" id="ap_materno" value="<?php echo $autor['ap_materno'] ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
    <a href="autores.php">Regresar</a>
</body>
</html>
