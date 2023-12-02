<?php

require_once("../../dirs.php");
include_once APP_PATH . "/templates/header.php";

if (isset($_SESSION['user'])) {
    header('Location: ' . ROOT_URL . '\public');
}

?>

<main id="login">

    <section class="row-1">
        <img class="logo" src="../../assets/images/logo.png" alt="Logo del CIIE">
        <h1>Iniciar sesión</h1>
    </section>

    <section class="row-2">
        <!-- <form action="validarLogin.php" method="post"> -->
        <form method="post" enctype="multipart/form-data">

            <label>
                <span>DNI</span>
                <input type="text" name="dni" id="dni" required placeholder="46111222">
            </label>

            <label>
                <span>Contraseña</span>
                <input type="password" name="password" id="password" required placeholder="••••••••">
            </label>

            <button type="submit" name="accion" value="login">Enviar datos</button>
        </form>

        <a class="link" href="../recover">Olvidé mi contraseña</a>

        <span class="separator"></span>
        <a class="register" href="../register">No tengo cuenta</a>

    </section>
</main>

<!-- <script src="../../app/features/cookies.js"></script> -->
<script src="../../app/features/login.js"></script>