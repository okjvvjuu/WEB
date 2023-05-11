<?php

//Mostrar tipo de dato de cada variable
$array = [];
$str = "";
$int = 0;
$bool = true;

echo 'El tipo de dato de \$array es: '
 . gettype($array)
 . '<br/>';
echo 'El tipo de dato de \$str es: '
 . gettype($str)
 . '<br/>';
echo 'El tipo de dato de \$int es: '
 . gettype($int)
 . '<br/>';
echo 'El tipo de dato de \$bool es: '
 . gettype($bool)
 . '<br/>';
?>