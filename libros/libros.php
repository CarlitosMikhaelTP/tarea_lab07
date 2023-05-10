<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare("SELECT libro_id, anio, autor, titulo, ubicacion, especialidad, editorial FROM libro");
if (!$query) {
    die('Error en la consulta: ' . $conexion->error);
}


$query->execute();
$resultado = $query->get_result();

// Cerramos la conexión a la base de datos
desconectar($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro</title>
</head>
<body>
    <h1>Libro</h1>
    <a href="agregar.html">Nuevo Libro</a>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Año</th>
                <th>Autor</th>
                <th>Titulo</th>
                <th>Ubicacion</th>
                <th>Especialidad</th>
                <th>Editorial</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php

        // Recorremos el set de registros obtenidos
        while ($libro = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $libro['libro_id'] . '</td>';
            echo '<td>' . $libro['anio'] . '</td>';
            echo '<td>' . $libro['autor'] . '</td>';
            echo '<td>' . $libro['titulo'] . '</td>';
            echo '<td>' . $libro['ubicacion'] . '</td>';
            echo '<td>' . $libro['especialidad'] . '</td>';
            echo '<td>' . $libro['editorial'] . '</td>';
            echo '<td><a href="#">Editar</a> | <a href="#">Eliminar</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</body>
</html>