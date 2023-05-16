<?php
$category_id = $_GET['id'];
$category = CategoryController::getCategory($_GET['id']);
$products = ProductController::getProductsByCategory($category_id);
?>

<h2><?=$category->getName()?></h2>
<section class="articles">
    <?php foreach ($products as $product): ?>
        <article class="product">
            <figure>
                <div class="product-image">
                    <img src="<?= baseURL ?>uploads/images/<?= $product->getImage() ?>"/>
                </div>
                <figcaption>
                    <h3><?= $product->getName() ?></h3>
                    <p><?= $product->getPrice() ?>€</p>
                    <form action="" method="POST">
                        <input type="submit" value="Comprar" />
                    </form>
                </figcaption>
            </figure>
        </article>
    <?php endforeach; ?>
</section>