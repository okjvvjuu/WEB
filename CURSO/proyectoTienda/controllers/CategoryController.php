<?php

require_once './models/Category.php';

class CategoryController {

    public static function getAllCategories() {
        $db = Database::connect();
        $query = $db->query("SELECT * FROM categories;");
        for ($i = 0; $fetch = $query->fetch_object(); $i++) {
            $result[$i] = $fetch;
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
    
    public static function getCategoryName($cat_id) : string {
        return Database::connect()
                ->query("SELECT name FROM categories WHERE id = $cat_id")
                ->fetch_array()[0];
    }

    public function index() {
        echo 'Controlador categorias, accion index';
    }

    public function manage() {
        require_once './views/category/manage.php';
    }

    public function modify() {
        session_start();
        $_SESSION['temp']['category_id'];
        require_once './views/category/modify.php';
    }

    public function save() {
        $category = new Category(null, $_POST['name']);
        try {
            if (!empty($_GET['id']) && $category->exists()) {
                $category->deleteSelfFromDatabase();
            }
            $category->save();
            header('Location:' . baseURL . 'Category/manage');
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = CategoryController::getCategory($id);
        }
        if (!$category) {
            $_SESSION['lstError']['category_delete'] = 'La categoría no se encuentra, vuelva a intentarlo más tarde';
        } else {
            $category->deleteSelfFromDatabase();
        }
        header('Location:'.baseURL.'Category/manage');
    }

}
