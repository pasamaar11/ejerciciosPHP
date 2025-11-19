<?php
$conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        #tabla {
            margin: auto;
            width: fit-content;
        }

        table {
            border-collapse: collapse;
        }

        #mensajeGama {
            color: #3c7ee0ff;
        }
    </style>
</head>

<body>
    <h1>Consulta de productos</h1>
    <form method="post">
        <label>Elige una de las gamas de productos disponible:</label>
        <select name="gama">
            <?php
            $consulta = "SELECT DISTINCT gama FROM gamasProductos";
            $resultado = mysqli_query($conexion, $consulta);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['gama'] . "'>" . $fila['gama'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Consultar productos">
    </form>

    <?php
    if (isset($_POST['gama'])) {

        $gamaSeleccionada = $_POST['gama'];

        echo "<p id='mensajeGama'><b>Productos de la gama $gamaSeleccionada - Fecha: 20/11/2025</b></p>";

        $sqlProductos = "
            SELECT CodigoProducto, Nombre, CantidadEnStock 
            FROM productos 
            WHERE Gama = '$gamaSeleccionada'
            ORDER BY Nombre
            ";

        $resultadoProductos = mysqli_query($conexion, $sqlProductos);

        // Si no hay productos → solo mensaje
        if (mysqli_num_rows($resultadoProductos) === 0) {
            echo "<p>Actualmente no existe ningún producto dado de alta en esta gama</p>";
        } else {
            // Si sí hay productos → mostrar tabla
            echo "<div id='tabla'>";
            echo "<table border='1'>
                    <tr>
                        <th>Código producto</th>
                        <th>Nombre</th>
                        <th>Cantidad en stock</th>
                    </tr>";

            while ($producto = mysqli_fetch_assoc($resultadoProductos)) {
                echo "<tr>";
                echo "<td>" . $producto['CodigoProducto'] . "</td>";
                echo "<td>" . $producto['Nombre'] . "</td>";
                echo "<td>" . $producto['CantidadEnStock'] . "</td>";
                echo "</tr>";
            }

            echo "</table></div>";
        }
    }

    mysqli_close($conexion);
    ?>

</body>

</html>