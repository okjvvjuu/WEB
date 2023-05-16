<?php

require_once './models/Product.php';
require_once './models/Cart.php';

class CartController {

    public function add() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = new Cart();
        }
        if (!isset($_GET['id']) || empty($_GET['id']) || !isset($_POST['qty']) || empty($_POST['qty'])) {
            echo defaultErrorMessage;
        } else {
            $id = $_GET['id'];
            $qty = isset($_POST['qty']) && !empty($_POST['qty']) ? $_POST['qty'] : 1;
            $product = ProductController::takeProduct($id, $qty);
            if (!$product) {
                //WIP - mostrar mensaje de error (no quedan más artículos)
                echo defaultErrorMessage;
            } else {
                $_SESSION['cart']->addProduct($product, $qty);
                header('Location:' . baseURL . 'product/details&id=' . $_GET['id']);
            }
        }
    }

    public function remove() {
        $_SESSION['cart'] = null;
    }

    public function delete() {
        
    }

}
