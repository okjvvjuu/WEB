<?php

require_once './models/Product.php';
require_once './models/Cart.php';

class ProductController
{

    public function index()
    {
        require_once './views/product/featured.php';
    }

    public function manage()
    {
        if (Utils::isAdmin()) {
            require_once './views/product/manage.php';
        } else {
            $_SESSION['lstError']['product'] = 'Se requieren permisos de administrador para esto';
            header('Location: ' . $_SESSION['lastPage']);
        }
    }

    public function details()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            require_once './views/product/details.php';
        } else {
            $_SESSION['lstError']['product'] = 'No se ha seleccionado un producto válido';
            header('Location: ' . $_SESSION['lastPage']);
        }
    }

    public static function getAllProducts()
    {
        $db = Database::connect();
        try {
            $query = $db->query("SELECT * FROM products;");
            $result = null;
            for ($i = 0; $object = $query->fetch_object(); $i++) {
                $result[$i] = new Product($object->id, $object->name, $object->price, $object->date, $object->stock, $object->description, $object->sale, $object->image, $object->category_id);
            }
        } catch (Exception $e) {
            $_SESSION['lstError']['product'] = 'No se han podido obtener los productos de la base de datos';
        }
        return $result;
    }

    public static function getRandomProducts(int $qty)
    {

        if ($qty == -1) {
            $limit = '';
        } else {
            $limit = "LIMIT $qty";
        }

        $db = Database::connect();
        try {
            $query = $db->query("SELECT * FROM products ORDER BY RAND() $limit;");
            $result = null;
            for ($i = 0; $object = $query->fetch_object(); $i++) {
                $result[$i] = new Product($object->id, $object->name, $object->price, $object->date, $object->stock, $object->description, $object->sale, $object->image, $object->category_id);
            }
        } catch (Exception $e) {
            $_SESSION['lstError']['product'] = 'No se han podido obtener los productos de la base de datos';
            $result = false;
        }
        return $result;
    }

    public static function getFeaturedProducts(int $qty)
    {

        if ($qty == -1) {
            $limit = '';
        } else {
            $limit = "LIMIT $qty";
        }

        $db = Database::connect();
        try {
            $query = $db->query("SELECT * FROM products ORDER BY date $limit;");
            $result = null;
            for ($i = 0; $object = $query->fetch_object(); $i++) {
                $result[$i] = new Product($object->id, $object->name, $object->price, $object->date, $object->stock, $object->description, $object->sale, $object->image, $object->category_id);
            }
        } catch (Exception $e) {
            $_SESSION['lstError']['product'] = 'No se han podido obtener los productos de la base de datos';
            $result = false;
        }
        return $result;
    }

    public static function getProduct($id)
    {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM products WHERE id = '$id'");
        try {
            if ($query && $query->num_rows == 1) {
                $temp = $query->fetch_object();
                return new Product($temp->id, $temp->name, $temp->price, $temp->date, $temp->stock, $temp->description, $temp->sale, $temp->image, $temp->category_id);
            }
        } catch (Exception $e) {
            $_SESSION['lstError']['product'] = 'No se han podido obtener un producto de la base de datos';
        }
        return false;
    }

    public static function takeProduct($id, $qty)
    {
        $db = Database::connect();
        try {
            $query = $db->query("SELECT * FROM products WHERE id = '$id'");
            if ($query && $query->num_rows == 1) {
                $temp = $query->fetch_object();
                if ($qty < 0) {
                    $_SESSION['lstError']['product'] = 'No se pude añadir esa cantidad (' . $qty . ')';
                } else if (($newStock = $temp->stock - $qty - $_SESSION['cart']->getContent()[$temp->id]['quantity']) < 0) {
                    $_SESSION['lstError']['product'] = 'No hay suficiente stock para esa cantidad (' . $qty . ')';
                } else {
                    $product = new Product($temp->id, $temp->name, $temp->price, $temp->date, $newStock, $temp->description, $temp->sale, $temp->image, $temp->category_id);
                    return $product;
                }
            }
        } catch (Exception $e) {
            $_SESSION['lstError']['product'] = 'No se ha podido tomar un producto de la base de datos';
        }
        return false;
    }

    public static function getProductsByCategory($category_id)
    {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM products WHERE category_id = '$category_id'");
        $result = null;
        try {
            for ($i = 0; $object = $query->fetch_object(); $i++) {
                $result[$i] = new Product($object->id, $object->name, $object->price, $object->date, $object->stock, $object->description, $object->sale, $object->image, $object->category_id);
            }
        } catch (Exception $e) {
            $_SESSION['lstError']['product'] = 'No se han podido obtener los productos de la base de datos';
            $result = false;
        }
        return $result;
    }

    public function delete()
    {
        if (Utils::isAdmin()) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = self::getProduct($id);
            }
            if (!$product) {
                $_SESSION['lstError']['product'] = 'El producto no se encuentra, vuelva a intentarlo más tarde';
            } else {
                $product->deleteSelf();
            }
        } else {
            $_SESSION['lstError']['product'] = 'Se requieren permisos de administrador para esto';
            header('Location: ' . $_SESSION['lastPage']);
        }
        header('Location:' . baseURL . 'Product/manage');
    }

    public function modify()
    {
        if (Utils::isAdmin()) {
            require_once './views/product/modify.php';
        } else {
            $_SESSION['lstError']['product'] = 'Se requieren permisos de administrador para esto';
            header('Location: ' . $_SESSION['lastPage']);
        }
    }

    public function save()
    {
        if (Utils::isAdmin()) {
            $image = $_FILES['image']['size'] == 0 ? null : $_FILES['image'];
            if (is_null($image)) {
                //Pendiente de revisión
                if (!empty($_GET['id'])) {
                    $db = Database::connect();
                    $image = $db
                        ->query('SELECT image FROM products WHERE id = ' . $_GET['id'])
                        ->fetch_object()
                        ->image;
                }
                if (empty($_GET['id']) || is_null($image) || !Utils::searchFile('./uploads/images/' . $image)) {
                    $image = 'default.png';
                }
            }

            $name = isset($image['name']) ? $image['name'] : $image;
            $type = isset($image['type']) ? $image['type'] : '';
            $product = new Product($_GET['id'], $_POST['name'], $_POST['price'], (new DateTime('now', new DateTimeZone('Europe/Madrid')))->format("Y-m-d H-i-s"), $_POST['stock'], $_POST['description'], $_POST['sale'], $name, $_POST['category']);

            try {
                if (!empty($_GET['id']) && $product->exists()) {
                    $product->updateSelf();
                } else {
                    $product->save();
                }
                if ($type == "image/png") {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($image['tmp_name'], 'uploads/images/' . $name);
                } else if ($type != '') {
                    $_SESSION['lstError']['product'] = "El tipo de imagen ('" . $image['type'] . "') no es el correcto (png)";
                }
            } catch (Exception $e) {
                $_SESSION['lstError']['product'] = 'Ha habido un problema con la base de datos, inténtelo de nuevo';
            }
            header('Location:' . baseURL . 'Product/manage');
        } else {
            $_SESSION['lstError']['product'] = 'Se requieren permisos de administrador para esto';
            header('Location: ' . $_SESSION['lastPage']);
        }
    }
}
