<?php
    $conexion = mysqli_connect("localhost", "pasamar", "1234", "jardineria");
    if (!$conexion) {
        die("ERROR: No se pudo conectar con la base de datos" . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        div{
            border: 1px solid;
            padding-left: 10px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>Formulario para rellenar los datos de un nuevo cliente</h1>
    <div id="tabla">
        <form method="post">
            <label id="Nombre">Nombre del cliente: </label>
            <input type="text" name="Nombre" id="Nombre">
            <br/>
            <label id="NombreContacto">Nombre del contacto: </label>
            <input type="text" name="NombreContacto" id="NombreContacto">
            <br/>
            <label id="ApellidoContacto">Apellido del contacto: </label>
            <input type="text" name="ApellidoContacto" id="ApellidoContacto">
            <br/>
            <label id="Tlf">Teléfono: </label>
            <input type="text" name="NombreContacto" id="NombreContacto">
            <br/>
            <label id="fax">Fax: </label>
            <input type="text" name="fax" id="fax">
            <br/>
            <label id="Direccion1">Dirección 1: </label>
            <input type="text" name="Direccion1" id="Direccion1">
            <br/>
            <label id="Direccion2">Dirección 2: </label>
            <input type="text" name="Direccion2" id="Direccion2">
            <br/>
            <label id="Ciudad">Ciudad: </label>
            <input type="text" name="Ciudad" id="Ciudad">
            <br/>
            <label id="Region">Región</label>
            <input type="text" name="Region" id="Region">
            <br/>
            <label id="Pais">País: </label>
            <input type="text" name="Pais" id="Pais">
            <br/>
            <label id="CodigoPostal">Código Postal: </label>
            <input type="text" name="CodigoPostal" id="CodigoPostal">
            <br/>
            <label id="LímiteCredito">Límite crédito (Solo la cifra): </label>
            <input type="number" name="LimiteCredito" id="LimiteCredito"> €
            <br/>
            <label id="CodigoEmpleado">Código Empleado: </label>
            <select name="CodigoEmpleado">
                <?php  
                    $consulta = "SELECT DISTINCT CodigoEmpleado, Nombre, Apellido1 
                    FROM empleados
                    ORDER BY CodigoEmpleado";
                    $resultado = mysqli_query($conexion, $consulta);
                    while($fila = mysqli_fetch_assoc($resultado)){
                        echo "<option value = '" . $fila['CodigoEmpleado'] . ' - ' . $fila['Nombre'] . $fila['Apellido1'] . "'>". $fila['CodigoEmpleado']. ' - ' . $fila['Nombre'] . ' ' . $fila['Apellido1'] . "</option>";
                    }
                ?>
            </select>
            <br/><br/>
            <input type="submit" value="Insertar nuevo empleado">
        </form>
    </div>
</body>
<?php
    mysqli_close($conexion);
?>

</html>