<?php

//Funcion que valide un email (filter_var) -> recoger variable ($_GET) y validarla -> mostrar el resultado

if (isset($_GET['email'])) {
    echo validateEmail($_GET['email']) ? 'El email es válido':'El email NO es válido';
} else {
    echo 'no hay ningun email';
}

function validateEmail($email) : bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}