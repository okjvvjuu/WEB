<?php
$province = $_POST['province'];
$location = $_POST['location'];
$direction = $_POST['direction'];

$cart = $_SESSION['cart'];
$content = $cart->getContent();
?>

<h2>Revisar pedido</h2>

<div>
    <ul>
        <li>Usuario: <?= $_SESSION['user']->getName() ?></li>
        <li>Provincia: <?= $province ?></li>
        <li>Localidad: <?= $location ?></li>
        <li>Dirección: <?= $direction ?></li>
        <li>Artículos:
            <ol>
                <?php foreach ($content as $product): ?>
                    <li><?= $product['product']->getName() ?> x <?= $product['quantity'] ?> &rightarrow; <?= $product['product']->getPrice() * $product['quantity'] ?>€</li>
                <?php endforeach; ?>
            </ol>
        </li>
    </ul>

    <h3><u>Precio total: <?= $cart->getTotalCost() ?>€</u></h3>

    <a href="#" class="button">Continuar</a>

</div>