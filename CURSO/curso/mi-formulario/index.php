<!DOCTYPE html>

<html>
    <head>
        <title>Formulario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            div {
                margin-top: .6em;
                margin-bottom: .6em;
            }
        </style>
    </head>
    <body>
        <h1>Formulario</h1>
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'EMPTY_DATA') {
                echo "<b>$error. Introduce el valor de todos los campos correctamente</b>";
            }
        }
        ?>
        <form action="processForm.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Info personal</legend>
                <div>
                    <label for="name">Nombre: </label>
                    <input type="text" name="name" id="name">
                    <?= getError($_GET['error'], 'name') ?>

                    <label for="surname">Apellido: </label>
                    <input type="text" name="surname" id="surname">
                    <?= getError($_GET['error'], 'surname') ?>
                </div>
                <div>
                    <label for="button">Botón: </label>
                    <input type="button" name="button" value="blabla" id="button">
                </div>
                <fieldset>
                    <legend>Sexo:</legend>
                    <span>
                        <label for="sexo_hombre">Hombre </label>
                        <input type="radio" name="sex" id="sexo_hombre" value="man">
                        <label for="sexo_mujer">Mujer </label>
                        <input type="radio" name="sex" id="sexo_mujer" value="woman">
                        <label for="sexo_otro">Otro </label>
                        <input type="radio" name="sex" value="other" id="sexo_otro" checked="checked">
                        <label for="sexo_legend">LEGENDARIO </label>
                        <input type="radio" name="sex" value="legend" id="sexo_legend">
                    </span>
                    <?= getError($_GET['error'], 'sex') ?>
                </fieldset>
                <div>
                    <label for="color">Color: </label>
                    <input type="color" name="color" value="#00ff00"  id="color">
                    <?= getError($_GET['error'], 'color') ?>
                </div>
                <div>
                    <label for="date">Fecha: </label>
                    <input type="date" name="date" id="date">
                    <?php if ($_GET['error'] == 'date'): ?>
                        <?= '<b style="color: red">Introduzca la fecha correctamente</b>' ?>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email">
                    <?= getError($_GET['error'], 'email') ?>
                </div>
                <div>
                    <label for="pswd">Contraseña: </label>
                    <input type="password" name="password" id="pswd">
                    <?= getError($_GET['error'], 'password') ?>
                </div>
                <div>
                    <label for="file">Archivo: </label>
                    <input type="file" name="file" multiple="multiple"  id="file">
                </div>
                <fieldset>
                    <legend>Checkboxes</legend>
                    <label for="check1">Opt1: </label>   
                    <input type="checkbox" name="check1" id="check1" value="opt1">
                    <label for="check2">Opt2: </label>   
                    <input type="checkbox" name="check2" id="check2" value="opt2">
                    <label for="check3">Opt3: </label>   
                    <input type="checkbox" name="check3" id="check3" value="opt3">
                    <label for="check4">Opt4: </label>   
                    <input type="checkbox" name="check4" id="check4" value="opt4">
                </fieldset>

                <div>
                    <label for="web">URL: </label>
                    <input type="url" name="web">
                    <?= getError($_GET['error'], 'web') ?>
                </div>

                <label for="area">TextArea:</label>
                <br/>
                <textarea id="area" name="area" rows="4" cols="20"></textarea>

                <div>
                    <label for="select">Películas: </label>
                    <select id="select" name="film">
                        <option value="Expideman">Expideman</option>
                        <option value="Expideman2">Expideman2</option>
                        <option value="Expideman3">Expideman3</option>
                    </select>
                </div>

                <input type="submit" value="Enviar" />

            </fieldset>
        </form>
        <?php

        function getError($error, $errorType) {
            if ($error == $errorType) {
                return '<b style="color: red">Introduzca el valor correctamente</b>';
            } else {
                return '';
            }
        }
        ?>
    </body>
</html>