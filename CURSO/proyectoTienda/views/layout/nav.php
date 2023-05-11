<nav>
    <ul>
        <li><a href="<?=baseURL?>">Inicio</a></li>
        
        <?php
        require_once './controllers/CategoryController.php';
        $array = CategoryController::getAllCategories();

        foreach ($array as $key => $value):?>
        <li><a href="#"><?=$value->name?></a></li>
        <?php endforeach; ?>

        <li><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></li>
    </ul>
</nav>