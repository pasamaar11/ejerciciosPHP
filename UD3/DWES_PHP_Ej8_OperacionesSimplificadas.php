<?php
$x = 6;
$y = $x / 2 + 3;

echo "<p><b>Cuadrado</b></p>";
echo "X vale: $x<br>";
echo "Y vale: $y<br>";
echo "Área: " . ($x * $y) . "<br>";
echo "Perímetro: " . ($x * 4) . "<br><br>";

$y = $x * 2;

echo "<p><b>Rectángulo</b></p>";
echo "X vale: $x<br>";
echo "Y vale: $y<br>";
echo "Área: " . ($x * $y) . "<br>";
echo "Perímetro: " . (($x * 2) + ($y * 2)) . "<br>";
?>