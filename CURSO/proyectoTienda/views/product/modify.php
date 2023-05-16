<?php
require_once './models/Product.php';

$db = Database::connect();
$query = $db->query("SELECT * FROM products WHERE id = '" . $_GET['id'] . "';");
if ($query && $query->num_rows == 1) {
    $temp = $query->fetch_object();
}
?>

<h2>
    <?php
    if (isset($_GET['id'])) {
        echo "Modificar producto ($temp->name)";
    } else {
        echo "Nuevo producto";
    }
    ?>
</h2>
<form action="<?= baseURL ?>Product/save&id=<?= $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
    <br/>
    <div class="input-box">
        <input type="text" name="name" id="name" value="<?= $temp->name ?>" required />
        <label for="name">Nombre del producto:</label>
    </div>
    <div class="input-box">
        <input type="text" name="price" id="price" value="<?= $temp->price ?>" required />
        <label for="price">Precio:</label>
    </div>
    <div class="input-box">
        <input type="text" name="stock" id="stock" value="<?= $temp->stock ?>" required />
        <label for="stock">Stock:</label>
    </div>
    <label for="name">Descripción del producto:</label>
    <textarea id="description" name="description" required><?= trim($temp->description) ?></textarea>
    <div class="input-box">
        <input type="text" name="sale" id="sale" value="<?= $temp->sale ?>" required />
        <label for="sale">Descuento (x%):</label>
    </div>

    <div class="inline-input-box">
        <label for="category">Categoría:</label>
        <select id="category" name="category" >
            <?php
            foreach (CategoryController::getAllCategories() as $value) :
                if ($value->getId() == $temp->category_id) :
                    ?>
                    <option value="<?= $value->getId() ?>" selected ><?= $value->getName() ?></option>
                <?php else: ?>
                    <option value="<?= $value->getId() ?>"><?= $value->getName() ?></option>
    <?php endif; ?>
<?php endforeach; ?>
        </select>
    </div>
    <div class="inline-input-box">
        <label for="name">Imagen del producto (formato png):</label>
        <input type="file" name="image" id="image" />
    </div>
    <input type="submit" value="Confirmar">
</form>