<?php
    $numero1 = 34.45;
    $numero2 = 12.16;

    $suma = $numero1 + $numero2;
    $resta = $numero1 - $numero2;
    $producto = $numero1 * $numero2;
    $division = $numero1 / $numero2;    
    $cociente = $numero1 % $numero2;
    $resto = $numero1 - ($cociente * $numero2);

    print "Suma: " . $suma . " Tipo: "  .gettype($suma) . "<br>";
    print "Resta: " . $resta . " Tipo: "  .gettype($resta) ."<br>";
    print "Producto: " . $producto ." Tipo: "  . gettype($producto) . "<br>";
    print "División: " . $division . " Tipo: "  .gettype($division) ."<br>";
    print "Cociente: " . $cociente . " Tipo: "  . gettype($cociente) ."<br>";
    print "Resto: " . $resto . " Tipo: "  . gettype($resto);
    ?>