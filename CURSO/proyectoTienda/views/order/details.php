<?php
$orderId = $_GET['id'];
$order = (new Order($orderId))->fetch();
$products = $order->getOrderedProducts(-1);

if (isset($_SESSION['lstError']['order'])) {
    require_once './views/layout/errorMessage.php';
    unset($_SESSION['lstError']['order']);
}

?>

<h2>Detalles del pedido</h2>
<div>
    <div class="order-info" style="font-size: 1.5em;">
        <h4>Resumen:</h4>
        <ul>
            <li><b>Dirección de envío:</b> <?= $order->getDirection() . ' (' . $order->getLocation() . ', ' . $order->getProvince() . ')' ?></li>
            <li><b>Precio total:</b> <?= $order->getPrice() ?></li>
            <li><b>Estado:</b> <?= $order->getStatusForDisplay() ?></li>
        </ul>
    </div>
    <br/>
    <h2>Productos del pedido</h2>
    <ul class="cart">
        <?php
        foreach ($products as $product) :
            $price = $product['product']->realPrice();
            $name = $product['product']->getName();
            $qty = $product['quantity'];
            ?>
            <li>
                <figure class="cart-item">
                    <img src="<?= baseURL ?>uploads/images/<?= $product['product']->getImage() ?>" alt="<?= $name ?>"/>
                    <figcaption>
                        <h3><?= $name ?></h3>
                        <span>Cantidad: <?= $qty ?></span>
                        <span>(<?= $qty ?> x <?= $price ?>€ = <?= $price * $qty ?>€)</span>
                    </figcaption>
                </figure>
            </li>
            <?php
        endforeach;
        ?>
    </ul>

    <h3>Total: <?= $order->getPrice() ?>€</h3>
</div>