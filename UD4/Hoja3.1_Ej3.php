<?php
    $conexion = mysqli_connect("localhost", "pasamar","1234","jardineria");

    if(!$conexion){
        die("Fallo en la conexion con la base de datos" . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <h1>Estadística de productos por gama</h1>        
        <div id="tabla">
            <?php 
                $consulta = "SELECT gp.Gama, gp.DescripcionTexto,COUNT(p.CodigoProducto) as TotalProductos
                        FROM gamasProductos gp
                        LEFT JOIN productos p ON gp.Gama = p.Gama
                        GROUP BY gp.Gama, gp.DescripcionTexto
                        ORDER BY gp.Gama";
                $resultado = mysqli_query($conexion, $consulta);

                if($resultado && mysqli_num_rows($resultado) > 0){
                    echo "<table border = '1'>";
                    echo "
                    <tr>
                        <th>Gama</th>
                        <th>Descripcion</th>
                        <th>Nº de productos</th>
                    </tr>";

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    if(!($fila['TotalProductos'] == 0)){
                    echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['Gama']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['DescripcionTexto']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['TotalProductos']) . "</td>";
                    echo "</tr>";
                    }
                }
                echo "</table>";
                }
            ?>
        </div>
        <?php 
            mysqli_close($conexion);
        ?>
    </body>
</html>