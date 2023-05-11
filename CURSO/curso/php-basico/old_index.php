<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        //Variables superglobales
        //De servidor
        
        echo $_SERVER['PHP_SELF'];
        echo '<br/>';
        echo $_SERVER['SCRIPT_URI'];
        echo '<br/>';
        echo $_SERVER['SERVER_ADDR'];
        echo '<br/>';
        echo $_SERVER['SERVER_NAME'];
        echo '<br/>';
        echo $_SERVER['SERVER_SOFTWARE'];
        echo '<br/>';
        echo $_SERVER['HTTP_USER_AGENT'];
        echo '<br/>';
        echo $_SERVER['REMOTE_ADDR'];
        echo '<br/>';
        ?>

        
<?php
$numero1 = 65;
$numero2 = 33;

echo 'Suma: ' . $numero1 + $numero2 . '<br/>';
echo 'Resta: ' . $numero1 - $numero2 . '<br/>';
echo 'Multiplicación: ' . $numero1 * $numero2 . '<br/>';
echo 'División: ' . $numero1 / $numero2 . '<br/>';
echo 'Resto: ' . $numero1 % $numero2 . '<br/>';
echo '(pre)Incremento: ' . ++$numero1 . '<br/>';
echo '(pre)Decremento: ' . --$numero1 . '<br/>';

echo '<hr/>';

$asignacion = 'Asignación: '
        . '<ul>'
        . '<li>Igual: =</li>'
        . '<li>Igual suma: +=</li>'
        . '<li>Igual resta: -=</li>'
        . '<li>Igual multiplicación: *=</li>'
        . '<li>Igual división: /=</li>'
        . '<li>Igual resto: %=</li>'
        . '</ul>';

echo $asignacion;
?>
        
        <?php
        define('constante', 'hola');
        $variable2 = ': ' . gettype(constante);
        $variable3 = 'buenos dias, soy una variable'
                . '<br/>'
                . "buenos días, soy una variable: $variable2";
//blablaba
        var_dump(constante);
        echo $variable3
        . $variable2
        . '<hr/>';

        echo '<ul>'
        . '<li>GTA</li>'
        . '<li>Fifa</li>'
        . '</li>'
        . '</ul>';

        echo PHP_OS;

        echo __CLASS__;
        ?>
        <?= 'hola' ?>
        -->
    </body>
</html>
