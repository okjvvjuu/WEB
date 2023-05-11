

<?php

echo '<b>Input: </b>';
var_dump($_POST);
echo '<br/>';
echo '<hr/>';

//Comprobar todos los campos del formulario:
$error = '';
$fields = [];

//Hecho así, es vulnerable a que el cliente modifique el html de la página, creando campos que no deberían existir y dejando sin crear campos potencialmente necesarios
/*
  foreach (array_keys($_POST) as $i) {
  if (empty($_POST["$i"])) {
  $error = 'EMPTY_DATA';
  }

  $$i = $_POST["$i"];
  $fields[$i] = $$i;

  echo "<u><b>$i</b> será una nueva variable con valor \"<b>".$$i.'</b>"</u>';

  echo '<br/>';
  }
 */

$fields['name'] = $_POST['name'];
$fields['surname'] = $_POST['surname'];
$fields['sex'] = $_POST['sex'];
$fields['color'] = $_POST['color'];
$fields['date'] = $_POST['date'];
$fields['email'] = $_POST['email'];
$fields['password'] = $_POST['password'];
$fields['check1'] = $_POST['check1'];
$fields['check2'] = $_POST['check2'];
$fields['check3'] = $_POST['check3'];
$fields['check4'] = $_POST['check4'];
$fields['web'] = $_POST['web'];
$fields['area'] = $_POST['area'];
$fields['film'] = $_POST['film'];

/*
 * INTENTO DE USAR ENUM, PREGUNTAR QUE FALLA CUANDO TENGA CONTACTO CON ELOY/haya visto el uso de enums en el curso
  if ($check) {
  header("Location:index.php?error='".(Errors::EMPTY_DATA->name)."'");
  }
 */

//Validar campos del formulario individualmente
if (empty($fields['name'])) {
    $error = 'name';
} else if (empty($fields['surname'])) {
    $error = 'surname';
} else if ($fields['sex'] <> 'man' && $fields['sex'] <> 'woman' && $fields['sex'] <> 'other' && $fields['sex'] <> 'legend') {
    $error = 'sex';
} else if (empty($fields['color'])) {
    $error = 'color';
} else if (empty($fields['date'])) {
    $error = 'date';
} else if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
    $error = 'email';
} else if (strlen($fields['password']) < 5) {
    $error = 'password';
} else if (!filter_var($fields['web'], FILTER_VALIDATE_DOMAIN)) {
    $error = 'web';
}

//Validar (?) campos opcionales (checkboxes) -- autorrellenables
for ($i = 1; $i <= 4; $i++) {
    if ($fields['check'.$i] <> 'opt'.$i) {
        $fields['check'.$i] = false;
    }
}

//Envío de error final (si lo hay)
if (!empty($error)) {
    header("Location:index.php?error=$error");
}

echo '<hr/>';

echo '<b>Result: </b>';
var_dump($fields);
echo '<br/>';
echo '<hr/>';

echo '¿Hay error? ';
echo $check ? 'sí (algo falla, tiene que reenviarte al formulario)' : 'no';
echo '<br/>';
echo '<hr/>';
