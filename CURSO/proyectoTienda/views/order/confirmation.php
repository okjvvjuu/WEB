<?php
$userId = $_SESSION['user']->getId();
$order = (new Order())->getLastOrder($userId);
?>
<h2>Tu pedido ha sido completado</h2>

<div class="form">
    <h3 style="text-align: center;"><a href="">&gt; Ver tu pedido &lt;</a></h3>

    <div class="order-info">
        <h4>Resumen:</h4>
        <ul>
            <li><b>Dirección de envío:</b> <?= $order->getDirection() . ' (' . $order->getLocation() . ', ' . $order->getProvince() . ')' ?></li>
            <li><b>Precio total:</b> <?= $order->getPrice() ?></li>
            <li><b>Estado:</b> <?= $order->getStatus() ?></li>
        </ul>
    </div>
</div>