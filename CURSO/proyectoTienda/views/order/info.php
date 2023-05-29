
<h2>Datos del pedido</h2>

<?php
if (isset($_SESSION['lstError']['order'])) {
    require_once './views/layout/errorMessage.php';
    unset($_SESSION['lstError']['order']);
}
?>

<form action="<?=baseURL?>Order/check" method="POST">
    <div class="input-box">
        <input type="text" name="province" id="province" value="" required />
        <label for="province">Provincia:</label>
    </div>
    <div class="input-box">
        <input type="text" name="location" id="location" value="" required />
        <label for="location">Localidad:</label>
    </div>
    <div class="input-box">
        <input type="text" name="direction" id="direction" value="" required />
        <label for="province">Dirección:</label>
    </div>
    <input type="submit" value="Confirmar" />
</form>