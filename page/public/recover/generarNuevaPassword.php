<?php

$resetID = $_GET['id'];
?>

<form action="changePassword.php" method="post">
    ingrese su nueva contraseña
    <input type="password" required name="password" id="password">
    <input type="hidden" name="resetID" value="<?= $resetID ?>">

    <button type="submit">cambiar contraseña !!!</button>
</form>