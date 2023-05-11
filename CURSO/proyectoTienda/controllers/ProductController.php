<?php

require_once './models/Product.php';

class ProductController {

    public function index() {
        require_once './views/product/featured.php';
    }

    public function manage() {
        require_once './views/product/manage.php';
    }

    public static function getAllProductsAndCategory() {
        //ARREGLAR : DEBE DEVOLVER OBJETOS, NO TEXTO EN UN ARRAY ( y enb categorias tmb)
        $db = Database::connect();
        try {
            $query = $db->query("SELECT p.*, c.id AS id_from_category, c.name AS category FROM products AS p JOIN categories AS c ON c.id = p.category_id;");
            $result = null;
            for ($i = 0; $object = $query->fetch_object(); $i++) {
                $result[$i] = $object;
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $result;
    }

    public static function getProduct($id) {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM products WHERE id = '$id'");
        if ($query && $query->num_rows == 1) {
            $temp = $query->fetch_object();
            return new Product($temp->name, $temp->price, $temp->date, $temp->stock, $temp->description, $temp->sale, $temp->image);
        }
        return false;
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = self::getProduct($id);
        }
        if (!$product) {
            $_SESSION['lstError']['product_delete'] = 'El producto no se encuentra, vuelva a intentarlo más tarde';
        } else {
            $product->deleteSelfFromDatabase();
        }
        header('Location:' . baseURL . 'Product/manage');
    }

    public function modify() {
        session_start();
        require_once './views/product/modify.php';
    }

    public function save() {
        if (!isset($_POST['image'])) {
            $db = Database::connect();
            $image = $db
                            ->query('SELECT image FROM products WHERE id = ' . $_GET['id'])
                            ->fetch_object()
                    ->image;
        } else {
            $image = $_POST['image'];
        }

        $product = new Product($_POST['name'], $_POST['price'], date_create()->format("Y-m-d"), $_POST['stock'], $_POST['description'], $_POST['sale'], $image, $_POST['category']);
        
        try {
            if (!empty($_GET['id']) && $product->exists()) {
                $product->deleteSelfFromDatabase();
            }
            $product->save();
            header('Location:' . baseURL . 'Product/manage');
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

}
