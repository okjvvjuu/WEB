<?php
$province = $_POST['province'];
$location = $_POST['location'];
$direction = $_POST['direction'];

$cart = $_SESSION['cart'];
$content = $cart->getContent();
?>

<h2>Revisar pedido</h2>

<div class="order-info">
    <ul>
        <li><span>Usuario:</span> <span><?= $_SESSION['user']->getName() ?></span> </li>
        <li><span>Provincia:</span> <span><?= $_SESSION['province'] = $province ?></span> </li>
        <li><span>Localidad:</span>  <span><?= $_SESSION['location'] = $location ?></span> </li>
        <li><span>Dirección:</span>  <span><?= $_SESSION['direction'] = $direction ?></span></li>
    </ul>

    <div>
        <h3>Artículos:</h3>
        <ol>
            <?php foreach ($content as $product): ?>
                <li><?= $product['product']->getName() ?> x <?= $product['quantity'] ?> &rightarrow; <?= $product['product']->getPrice() * $product['quantity'] ?>€</li>
            <?php endforeach; ?>
        </ol>
        <div class="product-details_basic-info_blur"></div>
        <h3><u>Precio total: <?= $cart->getTotalCost() ?>€</u></h3>
    </div>

    <div style="text-align: center;">
        <a href="<?=baseURL?>Order/save" class="button">Continuar</a>
    </div>

</div>