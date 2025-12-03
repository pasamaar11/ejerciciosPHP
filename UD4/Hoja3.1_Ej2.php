<?php
$conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");

if (!$conexion) {
    die("Fallo en la conexion a la base de datos: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        h2{
            color: #0c86f8ff;
        }
    </style>
</head>

<body>
    <h1>Consulta de productos por gama</h1>
    <form>
        Elige una de las gamas de productos disponible:
        <?php
        $consulta = "SELECT DISTINCT gama FROM gamasProductos ORDER BY gama";
        $resultado = mysqli_query($conexion, $consulta);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<select name='gamaProducto'>";
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['gama'] . "'>" . $fila['gama'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "No hay gamas disponibles.";
        }
        ?>
        <input type="submit" value="Consultar Productos">
    </form>

    <br />
    <div id="tabla">
        <?php
        $gamaSeleccionada = "";
        if (isset($_GET['gamaProducto'])) {
            // Asignar el valor capturado del formulario a la variable
            $gamaSeleccionada = mysqli_real_escape_string($conexion, $_GET['gamaProducto']);
        }
        if ($gamaSeleccionada) {
            echo "<h2>Productos de la gama " . htmlspecialchars($gamaSeleccionada) . " - Fecha: 02/12/2025 </h2>";

            $consulta = "SELECT CodigoProducto, Nombre, CantidadEnStock
                        FROM productos
                        WHERE Gama = '$gamaSeleccionada'
                        ORDER BY Nombre";
            $resultado = mysqli_query($conexion, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                echo "<table border = '1'>";
                echo "<tr>
                        <th>Código Producto</th>
                        <th>Nombre</th>
                        <th>CantidadEnStock</th>
                    </tr>";

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['CodigoProducto']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['Nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['CantidadEnStock']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<h2>Actualmente no existe ningún producto dado de alta en esta gama</h2>";
            }
        }
        ?>
    </div>

    <?php
        mysqli_close($conexion);
    ?>
</body>

</html>