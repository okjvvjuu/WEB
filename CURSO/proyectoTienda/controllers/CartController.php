<?php

require_once './models/Product.php';
require_once './models/Cart.php';

class CartController {
    
    public static function createCart() {
        return new Cart();
    }

    public function index() {
        require_once './views/cart/index.php';
    }

    public function add() {
        if (!isset($_SESSION['cart'])) {
            $this->createCart();
        }
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo defaultErrorMessage;
        } else {
            $id = $_GET['id'];
            $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

            $product = ProductController::takeProduct($id, $qty);
            if (!$product) {
                $_SESSION['lstError']['cart_no-stock'] = 'No queda más stock (stock: ' . ProductController::getProduct($id)->getStock() . ')';
            } else {
                $_SESSION['cart']->addProduct($product, $qty);
            }
            header("location:" . $_SESSION['lastPage']);
        }
    }

    public function remove() {
        $_POST['qty'] = -1;
        $this->add();
    }
    
    public function addOne() {
        $_POST['qty'] = 1;
        $this->add();
    }

    public function delete() {
        $_SESSION['cart'] = new Cart();
    }

}
