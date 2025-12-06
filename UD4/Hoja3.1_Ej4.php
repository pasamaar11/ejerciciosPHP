<?php
//cambiar a localhost en clase
    $conexion = mysqli_connect("127.0.0.1: 3307","pasamar","1234","jardineria");
    if(!$conexion){
        die("ERROR: No se pudo conectar con la base de datos correctamente" . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
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
    <h1>Consulta de clientes por país</h1>
    <form method="post">
        <label>Elige país: </label>
        <select name="Pais">
            <?php 
                $consulta = "SELECT DISTINCT Pais FROM clientes";
                $resultado = mysqli_query($conexion,$consulta);
                while($fila = mysqli_fetch_assoc($resultado)){
                    echo "<option value = '" . $fila['Pais'] . "'>" . $fila['Pais'] . "</option>";
                }
            ?>
        </select>
        <input type="submit" value="Enviar consulta">
    </form>

    <?php  
        if(isset($_POST['Pais'])){
            $cliente = $_POST['Pais'];

            echo "<p id = 'mensajeCliente'><b>Listado de cliente de -- $cliente -- BBDD Jardineria</b></p>";
            $sqlClientes = "
                    SELECT CodigoCliente, NombreCliente, NombreContacto, ApellidoContacto
                    FROM clientes
                    WHERE Pais = '$cliente'
                    ORDER BY CodigoCliente
                    ";

            $resultadoClientes = mysqli_query($conexion,$sqlClientes);

            if(mysqli_num_rows($resultadoClientes) === 0){
                echo "<p>No hay clientes registrados en ese país.</p>";
            }else{
                echo "<div id = 'tabla'>";
                echo "<table border = '1'>";
                echo "<tr>";
                    echo "<th>Codigo</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>NombreContacto</th>";
                    echo "<th>ApellidoContacto</th>";
                echo "</tr>";

                while($clientela = mysqli_fetch_assoc($resultadoClientes)){
                    echo "<tr>";
                        echo "<td>" . $clientela['CodigoCliente'] . "</td>";
                        echo "<td>" . $clientela['NombreCliente'] . "</td>";
                        echo "<td>" . $clientela['NombreContacto'] . "</td>";
                        echo "<td>" . $clientela['ApellidoContacto'] . "</td>";
                    echo "</tr>";
                }

                echo "</table></div>";
            }
        }
    echo "<a href = http://localhost/PHP/ejerciciosPHP/UD4/Hoja3.1_Ej4.php>Realizar una nueva consulta</a>";
    mysqli_close($conexion);
    ?>
</body>
</html>