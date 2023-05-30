
<h2>Gestionar pedidos</h2>

<?php
if (isset($_SESSION['lstError']['order'])) {
    require_once './views/layout/errorMessage.php';
    unset($_SESSION['lstError']['order']);
}
?>

<div class="table">
    <table>
        <thead>
        <td>ID</td>
        <td>USUARIO</td>
        <td>PROVINCIA</td>
        <td>LOCALIDAD</td>
        <td>DIRECCIÓN</td>
        <td>PRECIO</td>
        <td>ESTADO</td>
        <td colspan="2">FECHA</td>
        </thead>
        <tbody>
            <?php
            $users = User::getAllUsers();
            foreach ($users as $user) {
                $ordersPerUser[$user->getId()] = Order::getAllOrders($user->getId());
            }
            foreach ($ordersPerUser as $userId => $orders):
                ?>
                <tr>
                    <td colspan="9"><div style="text-align: left;">Pedidos de <?= $name = (new User())->fetch($userId)->getName() ?></div></td>
                </tr>
                <?php
                foreach ($orders as $order) :
                    ?>
                    <tr>
                        <td>
                            <?= $order->getId() ?>
                        </td>
                        <td>
                            <?= $name ?>
                        </td>
                        <td>
                            <?= $order->getProvince() ?>
                        </td>
                        <td>
                            <?= $order->getLocation() ?>
                        </td>
                        <td>
                            <?= $order->getDirection() ?>
                        </td>
                        <td>
                            <?= $order->getPrice() ?>€
                        </td>
                        <td>
                            <?= $order->getStatusForDisplay() ?>
                        </td>
                        <td>
                            <?= $order->getDate() ?>
                        </td>
                        <td>
                            <a href="<?= baseURL ?>Order/modify&id=<?= $order->getId() ?>" class="button">Modificar</a>
                            <a href="<?= baseURL ?>Order/delete&id=<?= $order->getId() ?>" class="button error">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>