<?php

require_once './models/Category.php';
require_once './controllers/ProductController.php';

class CategoryController {

    public static function getAllCategories() {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM categories;");
        for ($i = 0; $fetch = $query->fetch_object(); $i++) {
            $result[$i] = new Category($fetch->id, $fetch->name);
        }
        return $result;
    }

    public static function getCategory($id) {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM categories WHERE id = '$id'");
        if ($query && $query->num_rows == 1) {
            $temp = $query->fetch_object();
            return new Category($temp->id, $temp->name);
        }
        return false;
    }

    public static function getCategoryName($cat_id): string {
        return Database::connect()
                        ->query("SELECT name FROM categories WHERE id = $cat_id")
                        ->fetch_array()[0];
    }

    public function index() {
        echo 'Controlador categorias, accion index';
    }

    public function manage() {
        if (Utils::isAdmin()) {
            require_once './views/category/manage.php';
        } else {
            echo defaultErrorMessage;
        }
    }

    public function productsByCategory() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            require_once './views/category/productsByCategory.php';
        } else {
            echo defaultErrorMessage;
        }
    }

    public function modify() {
        $_SESSION['temp']['category_id'];
        if (Utils::isAdmin()) {
            require_once './views/category/modify.php';
        } else {
            echo defaultErrorMessage;
        }
    }

    public function save() {
        if (Utils::isAdmin()) {
            $category = new Category($_GET['id'], $_POST['name']);
            try {
                if (isset($_GET['id'])) {
                    if (!empty($_GET['id']) && $category->exists()) {
                        $category->updateSelf();
                    } else {
                        $category = new Category(null, $_POST['name']);
                        $category->save();
                    }
                }
                header('Location:' . baseURL . 'Category/manage');
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
        } else {
            echo defaultErrorMessage;
        }
    }

    public function delete() {
        if (Utils::isAdmin()) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = CategoryController::getCategory($id);
            }
            if (!$category) {
                $_SESSION['lstError']['category_delete'] = 'La categoría no se encuentra, vuelva a intentarlo más tarde';
            } else {
                try {
                    $category->deleteSelfFromDatabase();
                    header('Location:' . baseURL . 'Category/manage');
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        } else {
            echo defaultErrorMessage;
        }
    }

}
