<?php
$db = Database::connect();
$query = $db->query("SELECT * FROM categories WHERE id = '" . $_GET['id'] . "';");
$category = null;
if ($query && $query->num_rows == 1) {
    $category = $query->fetch_object();
}

if (isset($_SESSION['lstError']['category'])) {
    require_once './views/layout/errorMessage.php';
    unset($_SESSION['lstError']['category']);
}
?>

<h2>
    <?php
    if (isset($_GET['id'])) {
        echo "Modificar categoría ($category->name)";
    } else {
        echo "Nueva categoría";
    }
    ?>
</h2>
<form action="<?= baseURL ?>Category/save&id=<?=$_GET['id']?>" method="POST">
    <br>
    <div class="input-box">
        <input type="text" name="name" id="name" value="<?= $category->name ?>" required />
        <label for="name">Nombre de la categoría:</label>
        <input type="submit" value="Confirmar">
    </div>
</form>