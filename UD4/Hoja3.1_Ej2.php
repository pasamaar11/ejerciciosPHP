<?php
$conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <h1>Consulta de productos por gama</h1>
    Elige una de las gamas de productos disponible:
    <?php
    $consulta = "SELECT DISTINCT gama FROM gamasProductos";
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
    echo "<br><br>";
    if($fila['gama'] === 'Aromáticas'){
        $aromaticas = "SELECT DISTINCT CodigoProducto, Nombre, CantidadEnStock FROM productos";
    }
    ?>
    <div id="tabla">
    <table border="1">
        <tr>
            <th>Código producto</th>
            <th>Nombre</th>
            <th>CantidadEnStock</th>
        </tr>

        <?php
        $conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");
        if ($conexion) {
            $resultado = mysqli_query($conexion, "SELECT * FROM productos");
            $fila = mysqli_fetch_assoc($resultado);
            foreach ($resultado as $fila) {
                echo "<tr>";
                echo "<td>" . $fila['CodigoProducto'] . "</td>";
                echo "<td>" . $fila['Nombre'] . "</td>";
                echo "<td>" . $fila['CantidadEnStock'] . "</td>";
                echo "</tr>";
            }

            mysqli_close($conexion);
            
        }
        ?>
    <?php
    echo 
    "<form method='post' action='$aromaticas'>
        <input type='submit' value='Consultar productos'>
    </form>";



    mysqli_close($conexion);
    ?>
</body>

</html>