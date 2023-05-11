<?php

//Formulario con 2 input (números) y 4 botones (operaciones) -> calculadora
//EXTRA: he hecho un historial (practicar variables de sesión)

session_start();

if (empty($_SESSION['history'])) {
    $_SESSION['history'][] = '<b>HISTORIAL</b>';
}

if (!empty($_POST['n1']) && !empty($_POST['n2'])) {
    $n1 = &$_POST['n1'];
    $n2 = &$_POST['n2'];
    switch ($_POST['operation']) {
        case 'Sumar':
            $result = $n1 + $n2;
            break;
        case 'Restar':
            $result = $n1 - $n2;
            break;
        case 'Multiplicar':
            $result = $n1 * $n2;
            break;
        case 'Dividir':
            $result = $n1 / $n2;
            break;
        default :
            $result = '-';
    }
    
    echo 'Resultado: '.$result;
    $_SESSION['history'][] = $result;
}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Calculadora</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="" method="POST">
            <label for="n1">Número 1: </label>
            <input type="number" name="n1" id="n1"/>
            
            <label for="n1">Número 2: </label>
            <input type="number" name="n2" id="n2"/>
            <hr/>
            <input type="submit" value="Sumar" name="operation" />
            <input type="submit" value="Restar" name="operation" />
            <input type="submit" value="Multiplicar" name="operation" />
            <input type="submit" value="Dividir" name="operation" />
        </form>
        <?php foreach ($_SESSION['history'] as $value) { echo '<br/>'.$value; } ?>
    </body>
</html>