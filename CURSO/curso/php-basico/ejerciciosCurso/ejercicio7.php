<?php 

$term1 = $_GET['n1'];
$term1 = isset($term1) ? $term1:0;
$term2 = $_GET['n2'];
$term2 = isset($term2) ? $term2:0;

//Comprobar que sea impar (y luego contar de 2 en 2)
if ($term1%2 == 0) {
    $term1++;
}

for ($i = $term1; $i < $term2; $i+=2) {
    echo $i;
    if ($i + 2 < $term2) {
        echo ', ';
    }
}
