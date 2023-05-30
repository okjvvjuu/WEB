<?php

require_once './models/Product.php';
require_once './models/Cart.php';

class CartController
{

    public static function createCart()
    {
        return new Cart();
    }

    public function index()
    {
        require_once './views/cart/index.php';
    }

    public function add()
    {
        header("location:" . $_SESSION['lastPage']);
        if (!isset($_SESSION['cart'])) {
            $this->createCart();
        }
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['lstError']['product'] = 'No se ha seleccionado bien el producto, intentelo de nuevo';
        } else {
            $id = $_GET['id'];
            $qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

            $product = ProductController::takeProduct($id, $qty);
            if ($product) {
                $_SESSION['cart']->addProduct($product, $qty);
            }
        }
    }

    public function remove()
    {
        $_POST['qty'] = -1;
        $this->add();
    }

    public function addOne()
    {
        $_POST['qty'] = 1;
        $this->add();
    }

    public function delete()
    {
        $_SESSION['cart'] = new Cart();
    }
}
