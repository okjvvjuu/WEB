<?php
$order = (new Order($_GET['id']))->fetch();
$province = $order->getProvince();
$location = $order->getLocation();
$direction = $order->getDirection();
$status = $order->getStatus();
?>

<h2>
    <?php
    if (isset($_SESSION['lstError']['order'])) {
        require_once './views/layout/errorMessage.php';
        unset($_SESSION['lstError']['order']);
    }

    if (isset($_GET['id'])) :
    ?>
</h2>
<form action="<?= baseURL ?>Order/check&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
    <br />
    <div class="input-box">
        <input type="text" name="province" id="province" value="<?= $province ?>" required />
        <label for="name">Provincia:</label>
    </div>
    <div class="input-box">
        <input type="text" name="location" id="location" value="<?= $location ?>" required />
        <label for="price">Localidad:</label>
    </div>
    <div class="input-box">
        <input type="text" name="direction" id="direction" value="<?= $direction ?>" required />
        <label for="stock">Dirección:</label>
    </div>
    <div class="inline-input-box">
        <label for="sale">Estado:</label>
        <select id="status" name="status">
            <?php
            $keys = array_column(OrderStatus::cases(), 'name');
            $values = array_column(OrderStatus::cases(), 'value');
            $options = array_combine($keys, $values);
            foreach ($options as $option => $value) :
                if ($option == $status) :
            ?>
                    <option value="<?= $option ?>" selected><?= $value ?></option>
                <?php else : ?>
                    <option value="<?= $option ?>"><?= $value ?></option>
            <?php endif;
            endforeach;
            ?>
        </select>
    </div>

    <input type="submit" value="Confirmar">
</form>

<?php endif; ?>