<?php

require_once 'models/User.php';

class UserController {

    public function index() {
        echo 'Controlador usuarios, accion index';
    }

    public function signin() {
        require_once './views/user/signin.php';
    }

    public function login() {
        if (isset($_POST) && Utils::checkRegisterData($_POST)) {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPasswordForLogin($_POST['password']);
            try {
                $login = $user->login();
            } catch (Exception $e) {
                $_SESSION['lstError']['login'] = $e->getMessage();
            }
            if (!$login) {
                $_SESSION['lstError']['login'] = 'Datos inválidos';
            } else {
                $_SESSION['user'] = $login;
            }
        } else {
            $_SESSION['lstError']['login'] = 'Datos inválidos';
        }
        header('Location:' . baseURL);
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            session_unset();
            header('Location:' . baseURL);
        }
    }

    public function save() {
        if (isset($_POST) && $check = Utils::checkRegisterData($_POST)) {
            $user = new User($_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname']);
            try {
                $save = $user->save();
            } catch (Exception $e) {
                $_SESSION['lstError']['signin'] = $e->getMessage();
            }
        } else {
            $_SESSION['lstError']['signin'] = 'Datos inválidos';
        }

        if ($check && $save) {
            header('Location:' . baseURL);
        } else {
            header('Location:' . baseURL . 'User/signin');
        }
    }

}
