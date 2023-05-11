<h2>Regístrate</h2>
<?php
if (isset($_SESSION['lstError']['signin'])) {
    require_once './views/layout/errorMessage.php';
    session_unset();
}
?>
<form action="<?= baseURL ?>User/save" method="POST">
    <div class="input-box">
        <input type="text" name="name" id="name" autocomplete="off" required="required"/>
        <label for="name">Nombre:</label>
    </div>
    <div class="input-box">
        <input type="text" name="surname" id="surname" autocomplete="off" required="required"/>
        <label for="surname">Apellido:</label>
    </div>
    <div class="input-box">
        <input type="email" name="email" id="email" autocomplete="off" required="required"/>
        <label for="email">Email:</label>
    </div>
    <div class="input-box">
        <input type="password" name="password" id="password" autocomplete="off" required="required"/>
        <label for="password">Contraseña:</label>
    </div>

    <input type="submit" value="Confirmar" />
</form>