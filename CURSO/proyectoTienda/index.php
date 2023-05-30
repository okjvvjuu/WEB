<!DOCTYPE html>

<?php
require_once './config/parameters.php';
require_once './config/db.php';
require_once './helpers/Utils.php';
require_once './models/User.php';
require_once './models/Product.php';
require_once './models/Cart.php';
require_once './controllers/CartController.php';
require_once './helpers/OrderStatus.php';

session_start();
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = CartController::createCart();
    $_SESSION['cart']->setTotalCost(0);
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
        <main>
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
        <?php
        require_once './views/layout/aside.php';
        require_once './views/layout/header.php';
        require_once './views/layout/nav.php';
        ?>
    </div>
</body>

</html>