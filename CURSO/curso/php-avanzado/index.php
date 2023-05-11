<!-- Bases de datos -->

<?php
//Conectar a base de datos
$conection = mysqli_connect("localhost", "www-data", "2811Pan_", "curso");

//Comprobar conexión
if (mysqli_connect_errno()) {
    echo 'nope';
} else {
    echo 'éxito<hr/>';
}

//Crear consulta
mysqli_query($conection, 'SET NAMES "utf8"');
$query = mysqli_query($conection, 'SELECT * FROM usuarios');

//Mostrar consulta
showQuery($query);

//Insertar datos igual, query con el insert

//(fetch recupera info hasta que devuelve null)
function showQuery($query) {
    while ($result = mysqli_fetch_assoc($query)) {
        foreach (array_keys($result) as $i) {
            echo $i . ' -> ' . $result[$i] . '<br/>';
        }
        echo '<hr/>';
    }
}
