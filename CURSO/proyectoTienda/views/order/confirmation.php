<?php
$userId = !isset($_SESSION['userId']) ? $_SESSION['user']->getId():$_SESSION['userId'];
$order = (new Order())->getLastOrder($userId);
unset($_SESSION['direction']);
unset($_SESSION['location']);
unset($_SESSION['province']);
unset($_SESSION['userId']);
?>
<h2>Tu pedido ha sido completado</h2>

<div class="form">
    <h3 style="text-align: center;"><a href="<?= baseURL ?>Order/index">&gt; Ver tu pedido &lt;</a></h3>

    <div class="order-info">
        <h4>Resumen:</h4>
        <ul>
            <li><b>Dirección de envío:</b> <?= $order->getDirection() . ' (' . $order->getLocation() . ', ' . $order->getProvince() . ')' ?></li>
            <li><b>Precio total:</b> <?= $order->getPrice() ?></li>
            <li><b>Estado:</b> <?= $order->getStatusForDisplay() ?></li>
        </ul>
    </div>
</div>