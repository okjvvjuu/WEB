<h2>Gestionar productos</h2>

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
            $categories = ProductController::getAllProductsAndCategory();
            foreach ($categories as $key => $value):
                ?>
                <tr>
                    <td>
                        <?= $value->name ?>
                    </td>
                    <td>
                        <?= $value->id ?>
                    </td>
                    <td>
                        <?= $value->category . ' (id=' . $value->id_from_category . ')' ?>
                    </td>
                    <td>
                        <?= $value->description ?>
                    </td>
                    <td>
                        <?= $value->price ?>€
                    </td>
                    <td>
                        <?= $value->stock ?>
                    </td>
                    <td>
                        <?= $value->sale ?>
                    </td>
                    <td>
                        <?= $value->image ?>
                    </td>
                    <td>
                        <?= $value->date ?>
                    </td>
                    <td>
                        <a href="<?= baseURL ?>Product/modify&id=<?= $value->id ?>" class="button">Modificar</a><a href="<?= baseURL ?>Category/delete&id=<?= $value->id ?>" class="button error">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="<?= baseURL ?>Category/modify" class="button">Crear producto</a>