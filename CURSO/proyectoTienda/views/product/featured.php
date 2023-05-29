<h2>Productos destacados</h2>
<section class="articles">
    <?php foreach (ProductController::getFeaturedProducts(-1) as $product): ?>
        <article class="product">
            <a href="<?=baseURL?>Product/details&id=<?=$product->getId()?>">
                <figure>
                    <div class="product-image">
                        <img src="<?= baseURL ?>uploads/images/<?= $product->getImage() ?>"/>
                    </div>
                    <figcaption>
                        <h3><?= $product->getName() ?></h3>
                        <p><?= $product->realPrice() ?>€</p>
                        <form action="<?=baseURL?>Cart/addOne&id=<?=$product->getId()?>" method="POST">
                            <input type="submit" value="Comprar" />
                        </form>
                    </figcaption>
                </figure>
            </a>
        </article>
    <?php endforeach; ?>
</section>