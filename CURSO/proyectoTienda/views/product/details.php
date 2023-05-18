<?php
if (!$product = ProductController::getProduct($_GET['id'])):
    echo '<h2>El producto no existe</h2>';
else :
    ?>

    <h2><?= $product->getName() ?></h2>
    <div class="product-details">
        <div class="product-details_img">
            <img src="<?= baseURL ?>uploads/images/<?= $product->getImage() ?>" alt="<?= $product->getName() ?>"/>
        </div>
        <div class="product-details_basic-info">
            <div>
                <p class="product-details_basic-info_desc">
                    <?= $product->getDescription() ?>
                    <br/>
                </p>
                <div class="product-details_basic-info_blur"></div>
            </div>
            <div class="product-details_basic-info_price-and-date">
                <p>Última vez actualizado: <?= $product->getDate() ?></p>
                <p>
                <div class="product-details_basic-info_price-and-date_price"><?= $product->getPrice() ?> €</div>
                <div>
                    <hr/><br/>
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