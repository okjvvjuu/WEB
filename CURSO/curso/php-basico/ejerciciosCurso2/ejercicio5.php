<?php 
//Hacer tabla
$table = [
    'ACCION' => ['GTA 5', 'COD', 'PUBG'],
    'AVENTURA' => ['Assasins Creed', 'Crash Bandicoot', 'Prince of Persia'],
    'DEPORTE' => ['Fifa', 'PES19', 'MotoGP']
];

$cat = array_keys($table);

?>

<table border ="1" style="border-collapse: collapse;">
    <tr id="header">
        <?php foreach ($cat as $category): ?>
        <th><?=$category?></th>
        <?php endforeach; ?>
    </tr>
    
    <?php foreach($table as $array): ?>
    <tr>
        <!-- Seria: contar cual array tiene mas elementos, bucle for para el número de filas, y luego con el mismo contador poner los elementos i de cada array (foreach $cat, por ejemplo) -->
    </tr>
    <?php endforeach; ?>
    
</table>