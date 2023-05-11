<?php 
$start = $_GET['n1'];
$end = $_GET['n2'];

for ($index = $start; $index < $end; $index++) {
    echo $index;
    if ($index != $end-1) {
        echo ', ';
    }
}

?>