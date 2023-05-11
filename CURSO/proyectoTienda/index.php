<!DOCTYPE html>

<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
require_once './config/parameters.php';
require_once './config/db.php';
require_once './helpers/Utils.php';

session_start();
?>

<html>
    <?php require_once './views/layout/head.php'; ?>
    <body>
        <?php require_once './views/layout/background.php'; ?>
        <div class="main">
            <?php require_once './views/layout/header.php'; ?>
            <?php require_once './views/layout/nav.php'; ?>            
            <?php require_once './views/layout/aside.php' ?>
            <main>
                <!-- Contenido de la página (controlador frontal)-->
                <?php
                $controllerName = '';
                $action = '';
                if (empty($_GET)) {
                    $controllerName = defaultController;
                    $action = defaultAction;
                } else {
                    if (isset($_GET['controller'])) {
                        $controllerName = $_GET['controller'] . 'Controller';
                    }
                    if (isset($_GET['action'])) {
                        $action = $_GET['action'];
                    }
                }

                require_once './autoload.php';

                if (class_exists($controllerName) && method_exists($controller = new $controllerName, $action)) {
                    $controller->$action();
                } else {
                    $error = new ErrorController();
                    $error->index();
                }

                require_once './views/layout/footer.php';
                ?>

            </main>
        </div>
    </body>
</html>