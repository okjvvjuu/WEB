<?php
require_once './models/User.php';
if (empty($_SESSION['user'])):
    ?>
    <aside>
        <?php
        if (isset($_SESSION['lstError']['login'])) {
            require_once './views/layout/errorMessage.php';
            unset($_SESSION['lstError']['login']);
        }
        ?>
        <form action="<?= baseURL ?>User/login" method="POST">
            <h3>Entrar a la web</h3>
            <div class="input-box">
                <input type="email" name="email" id="email" autocomplete="off" required />
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" id="password" autocomplete="off" required />
                <label for="password">Contraseña</label>
            </div>
            <input type="submit" value="Enviar" />
        </form>
    </aside>
<?php else: ?>
    <aside class="user">
        <h3><?= $_SESSION['user']->getName() ?></h3>
        <img src="<?= $_SESSION['user']->getImage() ?>" />
        <ul>
            <li><a href="#" class="aside-button">Mis pedidos</a></li>
    <?php if ($_SESSION['user']->getRol() == 'admin'): ?>
                <li><a href="<?= baseURL ?>Product/manage" class="aside-button">Gestionar productos</a></li>
                <li><a href="<?= baseURL ?>Category/manage" class="aside-button">Gestionar categorías</a></li>
    <?php endif; ?>
            <li><a href="<?= baseURL ?>User/logout" class="aside-button red">Cerrar sesión</a></li>
        </ul>
    </aside>
<?php endif;