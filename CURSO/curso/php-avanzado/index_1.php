<!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="archivo" />
            <input type="submit" value="Enviar" />
        </form>
        
        <h1>Listado de imágenes</h1>
        <?php
        $gestor = opendir('./images');
        if ($gestor) {
            while (($image = readdir($gestor)) !== false) {
                if ($image != '.' && $image != '..') {
                    echo "<img src = 'images/$image' width='20%'/><br/>";
                }
            }
        }
        ?>
    </body>
</html>



<!--
<?php



/*
//Abrir
$file = fopen("fichero_texto.txt", "a+");

fwrite($file, "\nTexto metido desde PHP");

rewind($file);

while(!feof($file)) {
    echo fgets($file);
    echo '<br/>';
}



//Cerrar
fclose($file);    
 * 
 */