<?php

//Recorrer y mostrar + ordenar y mostrar + mostrar longitud + buscar elemento de un array de 8 números

$numeros = [1, 7, 6, 5, 9, 3, 24, 5];

mostrarArray($numeros);
sort($numeros);
echo '<hr/>';
mostrarArray($numeros);
echo '<hr/>';
echo (count($numeros));
echo '<hr/>';

$result = array_search(24, $numeros);
if ($result) {
    echo ($result);
} else echo -1;

function mostrarArray($a) {
    foreach ($a as $value) {
        echo $value . ', ';
    }
}
