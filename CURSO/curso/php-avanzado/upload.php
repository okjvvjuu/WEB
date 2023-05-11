<?php

$archivo = $_FILES['archivo'];

$nombre = $archivo['name'];
$tipo = $archivo['type'];

if ($tipo == 'image/png' || $tipo == 'image/jpg' || $tipo == 'image/jpeg') {
    
    if (!is_dir('images')) {
        mkdir('images', 0777);
    }
    
    move_uploaded_file($archivo['tmp_name'], "images/$nombre");
    echo 'Imagen subida correctamente';
    
} else {
    echo 'Por favor, solo formato jpg/jpeg/png';
}

header("Refresh: 3; URL=index.php");