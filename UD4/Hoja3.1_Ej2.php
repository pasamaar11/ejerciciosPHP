<?php
$conexion = mysqli_connect("localhost", "pasamar", "1111", "jardineria");
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
    echo "<form method='post' action='Hoja3.1_Ej2_Resultado.php'>
                <input type='submit' value='Consultar productos'>
                </form>";



    mysqli_close($conexion);
    ?>
</body>

</html>