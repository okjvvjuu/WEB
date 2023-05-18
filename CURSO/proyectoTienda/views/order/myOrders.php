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
                $n1 = $products[0]->getName();
                $n2 = is_null($products[1]) ? '' : ', ' . $products[1]->getName();
                $n3 = is_null($products[2]) ? '' : ', ' . $products[2]->getName();
                $dots = is_null($products[3]) ? '' : '...';

                $i1 = $products[0]->getImage();
                $i2 = is_null($products[1]) ? 'default.png' : $products[1]->getImage();
                $i3 = is_null($products[2]) ? 'default.png' : $products[2]->getImage();
                ?>
                <li>
                    <figure class="cart-item">
                        <img src="<?= baseURL ?>uploads/images/<?= $i1 ?>" alt="alt" class="a"/>
                        <img src="<?= baseURL ?>uploads/images/<?= $i2 ?>" alt="alt" class="b"/>
                        <img src="<?= baseURL ?>uploads/images/<?= $i3 ?>" alt="alt" class="c"/>
                        <figcaption>
                            <div>
                                <h3><a href="<?=baseURL?>Order/details&id=<?=$order->getId()?>"><?= $n1, $n2, $n3, $dots ?></a></h3>
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