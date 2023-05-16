<!DOCTYPE html>

<?php
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
require_once './config/parameters.php';
require_once './config/db.php';
require_once './helpers/Utils.php';
require_once './models/User.php';
require_once './models/Product.php';
require_once './models/Cart.php';
require_once './controllers/CartController.php';

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = CartController::createCart();
}
?>

<html>
    <?php require_once './views/layout/head.php'; ?>
    <body>
        <?php
        require_once './views/layout/background.php';
        require_once './views/layout/leaves.php';
        ?>
        <div class="main">
            <?php
            require_once './views/layout/header.php';
            require_once './views/layout/nav.php';
            //Aquí debería ir aside, pero PHP interpreta que mi aside tiene salida html, por lo que no me deja cambiar ningun header si lo coloco aqui
            ?>
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
            <?php require_once './views/layout/aside.php'; ?>
        </div>
    </body>
</html>