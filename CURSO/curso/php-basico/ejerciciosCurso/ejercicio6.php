<?php 
echo '<h1>Tablas de multiplicar</h1>';

$start = 1;
$end= 10;

//Comienzo tabla
echo '<table style="border-collapse: collapse;">';

for ($index = $start; $index <= $end; $index++) {
    
    echo '<tr style="border: .25em solid black;">';
    echo "<td style=\"border: .25em solid black; padding: 1em\"><b>$index</b></td>";
    for ($j = 0; $j <= 10; $j++) {
        echo '<td style="border: 1px solid black; padding: 1em">&emsp;'.($j*$index).'</td>';
    }
    echo '</tr>';
    
}

//Fin de tabla
echo '</table>';

?>