<?php
    echo "Ingresa un número: ";
    fscanf(STDIN, "%d", $num);  // lee un número entero

    if ($num < 0) {
        echo "Negativo\n";
    } else if ($num == 0) {
        echo "El número es 0\n";
    } else {
        echo "Positivo\n";
    }
?>
