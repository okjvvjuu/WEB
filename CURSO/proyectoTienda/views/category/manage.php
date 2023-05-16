<h2>Gestionar categorías</h2>

<div class="table">
    <table>
        <thead>
        <td>ID</td>
        <td colspan="2">NAME</td>
        </thead>
        <tbody>
            <?php
            require_once './controllers/CategoryController.php';
            $categories = CategoryController::getAllCategories();
            foreach ($categories as $value):
                ?>
                <tr>
                    <td>
                        <?= $value->getId() ?>
                    </td>
                    <td>
                        <?= $value->getName() ?>
                    </td>
                    <td>
                        <a href="<?= baseURL ?>Category/modify&id=<?= $value->getId() ?>" class="button">Modificar</a><a href="<?= baseURL ?>Category/delete&id=<?= $value->getId() ?>" class="button error">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="<?= baseURL ?>Category/modify" class="button">Crear categoría</a>