<?php 
$array = [];
$maxLength = 120;
for ($i = 0; count($array) < $maxLength; $i++) {
    $array[] = $i;
    echo $i;
    if ($i != $maxLength-1) {
        echo ', ';
    }
}
?>