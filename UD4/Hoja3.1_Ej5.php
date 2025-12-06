<?php
    $conexion = mysqli_connect("127.0.0.1: 3307", "pasamar", "1234", "jardineria");
    if (!$conexion) {
        die("ERROR: No se pudo conectar con la base de datos" . mysqli_connect_error());
}

if(isset($_REQUEST['enviar'])){
    //con esto se cargan las variables del formulario en variables locales
    extract($_REQUEST);
    // 1. Sanear los datos (Crucial para prevenir inyecciones SQL)
        $Nombre = mysqli_real_escape_string($conexion, $Nombre);
        $NombreContacto = mysqli_real_escape_string($conexion, $NombreContacto);
        $ApellidoContacto = mysqli_real_escape_string($conexion, $ApellidoContacto);
        // La variable 'Tlf' se ha corregido en el HTML.
        $Tlf = mysqli_real_escape_string($conexion, $Tlf); 
        $fax = mysqli_real_escape_string($conexion, $fax);
        $Direccion1 = mysqli_real_escape_string($conexion, $Direccion1);
        $Direccion2 = mysqli_real_escape_string($conexion, $Direccion2);
        $Ciudad = mysqli_real_escape_string($conexion, $Ciudad);
        $Region = mysqli_real_escape_string($conexion, $Region);
        $Pais = mysqli_real_escape_string($conexion, $Pais);
        $CodigoPostal = mysqli_real_escape_string($conexion, $CodigoPostal);
        
        // Los campos numéricos se tratan como tales (el límite de crédito puede tener decimales)
        $LimiteCredito = (float)$LimiteCredito; 
        
        // 2. Extraer el CodigoEmpleado numérico
        // El CodigoEmpleado viene como "1 - Nombre Apellido", extraemos solo el '1'
        $codigoEmpleado_partes = explode(' - ', $CodigoEmpleado); 
        $CodigoEmpleadoRepVentas = (int)$codigoEmpleado_partes[0];

        // 3. Obtener el siguiente CodigoCliente disponible
        $consulta_max_id = "SELECT MAX(CodigoCliente) AS MaxID FROM clientes";
        $resultado_max_id = mysqli_query($conexion, $consulta_max_id);
        $fila_max_id = mysqli_fetch_assoc($resultado_max_id);
        $CodigoCliente = $fila_max_id['MaxID'] + 1;
        
        // 4. Crear la consulta de inserción
        $query_insert = "INSERT INTO clientes (
            CodigoCliente, 
            NombreCliente, 
            NombreContacto, 
            ApellidoContacto, 
            Telefono, 
            Fax, 
            LineaDireccion1, 
            LineaDireccion2, 
            Ciudad, 
            Region, 
            Pais, 
            CodigoPostal, 
            CodigoEmpleadoRepVentas, 
            LimiteCredito
        ) VALUES (
            $CodigoCliente, 
            '$Nombre', 
            '$NombreContacto', 
            '$ApellidoContacto', 
            '$Tlf', 
            '$fax', 
            '$Direccion1', 
            '$Direccion2', 
            '$Ciudad', 
            '$Region', 
            '$Pais', 
            '$CodigoPostal', 
            $CodigoEmpleadoRepVentas, 
            $LimiteCredito
        )";

        // 5. Ejecutar la consulta
        if (mysqli_query($conexion, $query_insert)) {
            echo "<p style='color: green; font-weight: bold;'>✅ Cliente insertado correctamente con Código: $CodigoCliente</p>";
        } else {
            echo "<p style='color: red; font-weight: bold;'>❌ ERROR al insertar cliente: " . mysqli_error($conexion) . "</p>";
        }
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
            <br
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
            <input type="submit" name="enviar" value="Insertar nuevo empleado">
        </form>
    </div>
</body>
<?php
    mysqli_close($conexion);
?>

</html>