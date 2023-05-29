<div class="error">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Error (compruebe si ha realizado todo correctamente)</strong>
  <p><?= $_SESSION['lstError'][array_key_last($_SESSION['lstError'])] ?></p>
</div>
