<?php
$orders = Order::getAllOrders($_SESSION['user']->getId());

//Listarlos (foreach)
//Enlace para vista indiviual en cada uno
?>
<h2>Mis pedidos</h2>
<div>
    <?php
    if (!$orders) :
        echo '<h3 style="text-align: center;">No has hecho ningún pedido aún</h3>';
    else :
        ?>
        <ul>
            <?php
            foreach ($orders as $order) :
                $products = $order->getOrderedProducts(4);
                $p1 = $products[0]->getName();
                $p2 = is_null($products[1]) ? '' : ', ' . $products[1]->getName();
                $p3 = is_null($products[2]) ? '' : ', ' . $products[2]->getName();
                $dots = is_null($products[3]) ? '' : '...';
                ?>
                <li>
                    <figure class="cart-item">
                        <img src="<<?= baseURL ?>uploads/images/default.png" alt="alt"/>
                        <figcaption>
                            <div>
                                <h3><?= $p1, $p2, $p3, $dots ?></h3>
                            </div>
                            <div>
                                <span><?= $order->getDate() ?></span>
                                <span>Precio: <?= $order->getPrice() ?>€</span>
                            </div>
                        </figcaption>
                    </figure>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>