<?php

// Crear sesión, usar una variable que acumule o disminuya en función de si un parametro $_GET 'counter' es 1 o 0;
session_start();

if (!isset($_SESSION['a'])) {
    $_SESSION['a'] = 0;
} else if (isset($_GET['counter'])) {
    if ($_GET['counter'] == 0) {
        $_SESSION['a']--;
    } else if ($_GET['counter'] == 1) {
        $_SESSION['a']++;
    }
}

if (isset($_SESSION['a'])) {
    echo $_SESSION['a'];
}