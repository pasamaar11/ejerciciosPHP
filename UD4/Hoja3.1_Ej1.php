<?php
$conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");

if ($conexion) {
    $mensaje = "Conexión correcta...";
} else {
    $mensaje = "Error en la conexión";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        #tabla{
            margin: auto;
            width: fit-content;
        }
        table {
            border-collapse: collapse;
        }

        .mensaje {
            color: #3c7ee0ff;
            font-weight: bold;
            font-size: 20px;
        }

    </style>
</head>

<body>
    <?php
    if ($conexion) {
        echo '<div class="mensaje">' . $mensaje . '<br/><br/>' . '</div>';
    }
    ?>
    <div id="tabla">
    <table border="1">
        <tr>
            <th>CODIGO CLIENTE</th>
            <th>NOMBRE CLIENTE</th>
            <th>NOMBRE CONTACTO</th>
        </tr>

        <?php
        $conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");
        if ($conexion) {
            $resultado = mysqli_query($conexion, "SELECT * FROM clientes");
            $fila = mysqli_fetch_assoc($resultado);
            foreach ($resultado as $fila) {
                echo "<tr>";
                echo "<td>" . $fila['CodigoCliente'] . "</td>";
                echo "<td>" . $fila['NombreCliente'] . "</td>";
                echo "<td>" . $fila['NombreContacto'] . "</td>";
                echo "</tr>";
            }

            mysqli_close($conexion);
            
        }
        ?>
    </table>
    </div>
</body>

</html>