<h2>Gestionar productos</h2>

<?php
if (isset($_SESSION['lstError']['product'])) {
    require_once './views/layout/errorMessage.php';
    unset($_SESSION['lstError']['product']);
}
?>

<div class="table">
    <table>
        <thead>
        <td>NOMBRE</td>
        <td>ID</td>
        <td>CATEGORÍA</td>
        <td>DESCRIPCIÓN</td>
        <td>PRECIO</td>
        <td>STOCK</td>
        <td>OFERTAS</td>
        <td>IMAGEN</td>
        <td colspan="2">FECHA</td>
        </thead>
        <tbody>
            <?php
            require_once './controllers/CategoryController.php';
            $products = ProductController::getAllProducts();
            foreach ($products as $product):
                ?>
                <tr>
                    <td>
                        <?= $product->getName() ?>
                    </td>
                    <td>
                        <?= $product->getId() ?>
                    </td>
                    <td>
                        <?= CategoryController::getCategory($product->getCategory_id())->getName() . ' (id=' . $product->getCategory_id() . ')' ?>
                    </td>
                    <td>
                        <?php
                        $length = 50;
                        if (strlen($print = $product->getDescription()) > $length) {
                            $print = substr($product->getDescription(), 0, $length).'...';
                        }
                        echo $print;
                        ?>
                    </td>
                    <td>
                        <?= $product->getPrice() ?>€
                    </td>
                    <td>
                        <?= $product->getStock() ?>
                    </td>
                    <td>
    <?= $product->getSale() ?>
                    </td>
                    <td>
                        <img src="../uploads/images/<?= $product->getImage() ?>" width="48" height="48" alt="image"/>
                    </td>
                    <td>
    <?= $product->getDate() ?>
                    </td>
                    <td>
                        <a href="<?= baseURL ?>Product/modify&id=<?= $product->getId() ?>" class="button">Modificar</a><a href="<?= baseURL ?>Product/delete&id=<?= $product->getId() ?>" class="button error">Eliminar</a>
                    </td>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="<?= baseURL ?>Product/modify" class="button">Crear producto</a>