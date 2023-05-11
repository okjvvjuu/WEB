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
            foreach ($categories as $key => $value):
                ?>
                <tr>
                    <td>
    <?= $value->id ?>
                    </td>
                    <td>
    <?= $value->name ?>
                    </td>
                    <td>
                        <a href="<?= baseURL ?>Category/modify&id=<?= $value->id ?>" class="button">Modificar</a><a href="<?= baseURL ?>Category/delete&id=<?= $value->id ?>" class="button error">Eliminar</a>
                    </td>
                </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="<?= baseURL ?>Category/modify" class="button">Crear categoría</a>