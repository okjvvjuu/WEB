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

    public function save() {
        if (isset($_SESSION['user'])) {
            $db = Database::connect();

            $user_id = $_SESSION['user']->getId();
            $province = $_SESSION['province'];
            unset($_SESSION['province']);
            $location = $_SESSION['location'];
            unset($_SESSION['location']);
            $direction = $_SESSION['direction'];
            unset($_SESSION['direction']);
            $price = $_SESSION['cart']->getTotalCost();
            $status = 'pending...';
            $date = date_create('now', new DateTimeZone('Europe/Madrid'))->format('Y-m-d H-i-s');

            $products = $_SESSION['cart']->getContent();

            try {
                $db->query("INSERT INTO orders VALUES(null,$user_id,'$province','$location','$direction',$price,'$status','$date');");
                $order_id = $db->query("SELECT id FROM orders WHERE user_id = $user_id AND date = '$date;'")->fetch_object()->id;
                foreach ($products as $product_id => $product) {
                    $qty = $product['quantity'];
                    $db->query("INSERT INTO orders_products VALUES(null,$order_id,$product_id,$qty);");
                }
                unset($_SESSION['cart']);
                header('Location:'.baseURL);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }
    }

}
