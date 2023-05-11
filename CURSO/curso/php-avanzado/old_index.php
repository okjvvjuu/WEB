<?php 
setcookie('micookie', 'valor de micookie');

if (isset($_COOKIE['micookie'])) {
    echo $_COOKIE['micookie'];
}
?>