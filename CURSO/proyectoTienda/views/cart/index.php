
<h2>Mi carrito</h2>
<ul class="cart">
    <?php
    require_once './models/Product.php';
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart']->getContent();
        foreach ($cart as $value) :
            $product = $value['product'];
            $price = $product->getPrice();
            $name = $product->getName();
            $qty = $value['quantity'];
            ?>
            <li>
                <figure class="cart-item">
                    <img src="<?= baseURL ?>uploads/images/<?= $product->getImage() ?>" alt="<?= $name ?>"/>
                    <figcaption>
                        <h3><?= $name ?></h3>
                        <span>Cantidad: <?= $qty ?></span>
                        <span>(<?= $qty ?> x <?= $price ?>€ = <?= $price * $qty ?>€)</span>
                        <span class="cart-item-buttons">
                            <a href="<?= baseURL ?>Cart/add&id=<?= $product->getId() ?>" class="button">+</a>
                            <a href="<?= baseURL ?>Cart/remove&id=<?= $product->getId() ?>" class="button">-</a>
                        </span>
                    </figcaption>
                </figure>
            </li>
            <?php
        endforeach;
    } else {
        echo '<h3 style="text-align: center;">No has añadido nada a tu carrito aun</h3>';
    }
    ?>
</ul>

<h3>Total: <?= $_SESSION['cart']->getTotalCost() ?>€</h3>

<form action="#" method="POST">
    <input type="submit" value="Finalizar compra" />
</form>