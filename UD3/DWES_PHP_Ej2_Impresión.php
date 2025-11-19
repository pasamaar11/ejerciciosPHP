<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        readline("Pulsa ENTER para comenzar");
        $peso = readline("¿Cuál es tu peso?");
        $altura = readline("¿Cuál es tu altura?");

        print("Tu peso actual es: " . $peso . "\nTu altura actual es: " . $altura);
        /*NO FUNCIONA EL READLINE PORQUE SOLO SE EJECUTA EN LA CONSOLA*/
    ?>
</body>
</html>

