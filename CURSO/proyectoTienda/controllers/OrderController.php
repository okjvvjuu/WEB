<?php

class OrderController {

    public function index() {
        echo 'Controlador pedidos, accion index';
    }

    public function info() {
        if (empty($_SESSION['cart']->getContent())) {
            header('Location:' . $_SESSION['lastPage']);
        } else if (!isset($_SESSION['user'])) {
            require_once './views/user/loginRequired.php';
        } else {
            require_once './views/order/info.php';
        }
    }

    public function check() {
        if (empty($_SESSION['cart']->getContent())) {
            header('Location:' . 'cart/index');
        } else if (!isset($_SESSION['user'])) {
            require_once './views/user/loginRequired.php';
        } else if (false) { //Funcion que compruebe los datos
            header('Location:' . 'cart/index');
        } else {
            require_once './views/order/check.php';
        }
    }

}
