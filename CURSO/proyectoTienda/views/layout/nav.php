<nav>
    <ul>
        <li><a href="<?=baseURL?>">Inicio</a></li>
        
        <?php
        require_once './controllers/CategoryController.php';
        $array = CategoryController::getAllCategories();

        foreach ($array as $value):?>
        <li><a href="<?=baseURL?>category/productsByCategory&id=<?=$value->getId()?>"><?=$value->getName()?></a></li>
        <?php endforeach; ?>

        <li><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
    </ul>
</nav>