<nav>
    <ul>
        <li><div><i class="fa-solid fa-bars"></i></div></li>
        <li><a href="<?= baseURL ?>">Inicio</a></li>

        <?php
        require_once './controllers/CategoryController.php';

        $array = CategoryController::getAllCategories();

        foreach ($array as $value):
            ?>
            <li><a href="<?= baseURL ?>Category/productsByCategory&id=<?= $value->getId() ?>"><?= $value->getName() ?></a></li>
        <?php endforeach; ?>

        <li>
            <a href="<?= baseURL ?>Cart/index"><i class="fa-solid fa-cart-shopping"></i></a><sub><?php
                if (isset($_SESSION['cart'])) {
                    $print = is_null($_SESSION['cart']->getContent()) ? 0 : count($_SESSION['cart']->getContent());
                    echo $print;
                }
                ?></sub>
        </li>
    </ul>
</nav>