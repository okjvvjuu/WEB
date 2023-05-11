<?php 
//Si variable esta vacía, que la rellene con texto en minusculas. Mostrarlo en mayusc. y negrita
$text = '';
if (!$text || empty($text)) {
    $text = 'default';
}
echo '<b>'.strtoupper($text).'</b>'
?>