<?php
$category_id = $_GET['id'];
$category = CategoryController::getCategory($_GET['id']);
$products = ProductController::getProductsByCategory($category_id);

if (isset($_SESSION['lstError']['category'])) {
    require_once './views/layout/errorMessage.php';
    unset($_SESSION['lstError']['category']);
}

?>

<h2><?= $category->getName() ?></h2>
<section class="articles">
    <?php foreach ($products as $product): ?>
        <article class="product">
            <a href="<?= baseURL ?>Product/details&id=<?= $product->getId() ?>">
                <figure>
                    <div class="product-image">
                        <img src="<?= baseURL ?>uploads/images/<?= $product->getImage() ?>"/>
                    </div>
                    <figcaption>
                        <h3><?= $product->getName() ?></h3>
                        <p><?= $product->getPrice() ?>€</p>
                        <form action="<?= baseURL ?>Cart/addOne&id=<?= $product->getId() ?>" method="POST">
                            <input type="submit" value="Comprar" />
                        </form>
                    </figcaption>
                </figure>
            </a>
        </article>
    <?php endforeach; ?>
</section>