<?php
$province = $_POST['province'];
$location = $_POST['location'];
$direction = $_POST['direction'];

$cart = $_SESSION['cart']->getContent();
?>

<h2>Revisar pedido</h2>

<ul>
    <li>Usuario: <?= $_SESSION['user']->getName() ?></li>
    <li>Provincia: <?= $province ?></li>
    <li>Localidad: <?= $location ?></li>
    <li>Dirección: <?= $direction ?></li>
    <li>Artículos:
        <ol>
            <?php foreach ($cart as $product): ?>
                <li><?= $product['product']->getName() ?></li>
            <?php endforeach; ?>
        </ol>
    </li>
</ul>
