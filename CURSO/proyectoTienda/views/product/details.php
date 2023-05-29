<?php
if (!$product = ProductController::getProduct($_GET['id'])) :
    echo '<h2>El producto no existe</h2>';
else :
    $price = $product->getPrice();
    if (($realPrice = $product->realPrice()) != $price) {
        $dif = $price - $realPrice;
        $percentage = round($dif / $price * 100);
        $price = "<strike>$price</strike> <u>$realPrice</u>€ <sup><sub>Ahorras $dif € ($percentage %)</sub></sup>";
    }
?>

    <h2><?= $product->getName() ?></h2>

    <?php
    if (isset($_SESSION['lstError']['product'])) {
        require_once './views/layout/errorMessage.php';
        unset($_SESSION['lstError']['product']);
    }
    ?>

    <div class="product-details">
        <div class="product-details_img">
            <img src="<?= baseURL ?>uploads/images/<?= $product->getImage() ?>" alt="<?= $product->getName() ?>" />
        </div>
        <div class="product-details_basic-info">
            <div>
                <p class="product-details_basic-info_desc">
                    <?= $product->getDescription() ?>
                    <br />
                </p>
                <div class="product-details_basic-info_blur"></div>
            </div>
            <div class="product-details_basic-info_price-and-date">
                <p>Última vez actualizado: <?= $product->getDate() ?></p>
                <br />
                <p>
                <div class="product-details_basic-info_price-and-date_price"><?= $price ?></div>
                <div>
                    <hr /><br />
                    <form action="<?= baseURL ?>Cart/add&id=<?= $product->getId() ?>" method="POST" class="buy">
                        <label for="qty">Cantidad: </label>
                        <input type="number" value="1" name="qty" id="qty" />
                        <input type="submit" value="Comprar" />
                    </form>
                </div>
                </p>
            </div>
        </div>
        <div class="product-details_more-info">
            <span>Stock: <?= $product->getStock() ?></span>
            <span>Categoría: <?= CategoryController::getCategory($product->getCategory_id())->getName() ?></span>
        </div>
    </div>

<?php endif; ?>