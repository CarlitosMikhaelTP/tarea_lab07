<?php

include('../conexion/conexion.php');

// Abrimos la conexión a la base de datos
$conexion = conectar();

// Consultamos a la base de datos
$query = $conexion->prepare("SELECT autor_id, nombre, ap_paterno, ap_materno FROM autor");
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
    <title>Autor</title>
</head>
<body>
    <h1>Autor</h1>
    <a href="agregar.html">Nuevo Autor</a>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php

        // Recorremos el set de registros obtenidos
        while ($autor = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $autor['autor_id'] . '</td>';
            echo '<td>' . $autor['nombre'] . '</td>';
            echo '<td>' . $autor['ap_paterno'] . '</td>';
            echo '<td>' . $autor['ap_materno'] . '</td>';
            echo '<td><a href="actualizar.html?id_autor=' . $autor['autor_id'] . '">Editar</a> | 
                      <a href="eliminar_autor.php?id_autor=' . $autor['autor_id'] . '">Eliminar</a></td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</body>
</html>