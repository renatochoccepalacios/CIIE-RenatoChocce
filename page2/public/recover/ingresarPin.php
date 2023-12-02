<?php

$resetID = $_GET['id'];

?>

<form action="validarPin.php?id=<?= $resetID ?>" method="post">
    <label>
        <span>pin</span>
        <input type="number" name="pin" id="pin" placeholder="ingrese el pin">
    </label>

    <button type="submit">validar</button>
</form>