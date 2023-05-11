<?php

$term1 = $_GET['numero1'];
$term1 = isset($term1) ? $term1:0;
$term2 = $_GET['numero2'];
$term2 = isset($term2) ? $term2:0;

echo 'Suma: ' . $term1 + $term2;
echo '<br/>Resta: ' . $term1 - $term2;
echo '<br/>Multiplicación: ' . $term1 * $term2;

$divResult = $term1 == 0 && $term2 == 0 ? "$term1/$term2 no puede realizarse":$term1 / $term2;

echo '<br/>División: ' . $divResult;
?>