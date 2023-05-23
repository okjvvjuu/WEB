<?php

require_once './models/Order.php';

class OrderController {

    public function index() {
        require_once './views/order/myOrders.php';
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
        if (empty($_SESSION['cart']->getContent()) && empty($_GET['id'])) {
            header('Location:' . 'cart/index');
        } else if (!isset($_SESSION['user'])) {
            require_once './views/user/loginRequired.php';
        } else if (false) { //Funcion que compruebe los datos
            header('Location:' . 'cart/index');
        } else {
            require_once './views/order/check.php';
        }
    }

    public function manage() {
        require_once './views/order/manage.php';
    }

    public function modify() {
        require_once './views/order/modify.php';
    }

    public function confirmation() {
        require_once './views/order/confirmation.php';
    }

    public function details() {
        require_once './views/order/details.php';
    }

    public function save() {
        if (isset($_SESSION['user'])) {
            $db = Database::connect();

            $user_id = $_SESSION['user']->getId();
            $province = $_SESSION['province'];
            $location = $_SESSION['location'];
            $direction = $_SESSION['direction'];
            $price = empty($_GET['id']) ? $_SESSION['cart']->getTotalCost():0;
            $status = empty($_GET['id']) ? OrderStatus::pending->name:$_SESSION['status'];
            $date = date_create('now', new DateTimeZone('Europe/Madrid'))->format('Y-m-d H-i-s');

            $products = empty($_GET['id']) ? $_SESSION['cart']->getContent():'';

            $order = new Order($_GET['id'], $user_id, $province, $location, $direction, $price, $status, $date);

            try {
                if (isset($_GET['id'])) {
                    if (!empty($_GET['id']) && $order->exists()) {
                        $old = $order->fetch();
                        $order->setPrice($old->getPrice());
                        $order->setUserId($_SESSION['userId'] = $old->getUserId());
                        $order->updateSelf();
                    } else {
                        $order->save();
                        $order_id = $db->query("SELECT id FROM orders WHERE user_id = $user_id ORDER BY date DESC LIMIT 1;")->fetch_object()->id;
                        $order->setId($order_id);
                        foreach ($products as $product_id => $product) {
                            $qty = $product['quantity'];
                            $db->query("INSERT INTO orders_products VALUES(null,$order_id,$product_id,$qty);");
                        }
                        unset($_SESSION['cart']);
                    }
                }
                $this->confirmation();
            } catch (Exception $ex) {
                echo $ex->getMessage();
                die();
            }
        }
    }

    public function delete() {
        if (Utils::isAdmin()) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $order = (new Order($id))->fetch();
            }
            if (!$order) {
                $_SESSION['lstError']['order_delete'] = 'La categoría no se encuentra, vuelva a intentarlo más tarde';
            } else {
                try {
                    $order->deleteSelfFromDatabase();
                    header('Location:' . $_SESSION['lastPage']);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                    die();
                }
            }
        } else {
            echo defaultErrorMessage;
            die();
        }
    }

}
