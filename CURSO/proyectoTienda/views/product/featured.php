<h2>Productos destacados</h2>
<section class="articles">
    <?php for ($i = 0; $i < 10; $i++): ?>
        <article class="product">
            <figure>
                <img src="<?=baseURL?>assets/img/sample_product.jpg"/>
                <figcaption>
                    <h3>Sample product</h3>
                    <p>999,99€</p>
                    <form action="" method="POST">
                        <input type="submit" value="Comprar" />
                    </form>
                </figcaption>
            </figure>
        </article>
    <?php endfor; ?>
</section>