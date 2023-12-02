<?php

require_once __DIR__ . '/../../dirs.php';

session_start();

if (
    $_SERVER['REQUEST_URI'] != '/CIIE/page/public/login/' &&
    $_SERVER['REQUEST_URI'] != '/CIIE/page/public/login/index.php' &&
    $_SERVER['REQUEST_URI'] != '/CIIE/page/public/cursos/' &&
    $_SERVER['REQUEST_URI'] != '/CIIE/page/public/cursos/index.php' &&
    $_SERVER['REQUEST_URI'] != '/CIIE/page/public/register/' &&
    $_SERVER['REQUEST_URI'] != '/CIIE/page/public/register/index.php'
) {
    if (!isset($_SESSION['user'])) {
        $_SESSION['source'] = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        header('Location: ' . ROOT_URL . '/public/login/');
    } else if (isset($_SESSION['source'])) {
        unset($_SESSION['source']);
    }
}

require_once __DIR__ . '/../models/DAL/UsuarioDAL.php'; ?>

<head>
    <!-- incluir estilos, fuentes, iconos, etc -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- iconos de google -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>

    <!-- estilos -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/styles/css/main.css">
    <title>CIIE</title>
</head>

<div id="header" class="public">
    <header>
        <section class="col-1">
            <a href="<?= ROOT_URL ?>\public">
                <!-- <img src="<?= ROOT_URL ?>/assets/images/logo2.png" alt="" class="logo"> -->
                CIIE
            </a>
            <nav>
                <ul>
                    <?php

                    if (isset($_SESSION['user'])) {
                        ?>
                        <li>
                            <a class="link" href="<?= ROOT_URL ?>\public\profile">Mi perfil</a>
                        </li>
                        <?php
                    }

                    ?>

                    <li>
                        <a class="link" href="<?= ROOT_URL ?>\public\cursos">Cursos</a>
                    </li>

                    <?php

                    if (isset($_SESSION['user']) && ($_SESSION['tipoCuenta'] == 2 || $_SESSION['tipoCuenta'] == 3)) {
                        ?>
                        <li><a class="link" href="<?= ROOT_URL ?>\admin">Administrar</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </section>

        <section class="col-2">
            <?php if (isset($_SESSION['user'])) {
                ?>
                <a class="link" href="<?= ROOT_URL ?>\public\login\logout.php">Cerrar sesión</a>
            <?php } ?>
        </section>
    </header>
</div>

<div id="alerts"></div>

<style>
    #alerts {
        z-index: 100;
        position: absolute;
        top: 0;
        width: 400px;
        right: 0;
        margin-top: 80px;
    }

    #alerts .message-container {
        margin: 25px 20px 0 20px;
        display: flex;
        flex-direction: row;
        align-items: center;
        transition: .35s all;
        background: #fff;
        color: #000;
        font-family: 'Urbanist';
        box-shadow: 0 4px 10px #00000030;
        translate: 100vw;
        border-radius: 8px;
    }

    #alerts .icon {
        padding: 20px;
        color: #fff;
        border-radius: 8px 0 0 8px;
        font-size: 30px;
    }

    #alerts .icon span {
        font-size: 30px
    }

    #alerts .error .icon {
        background: #CA3C3B;
    }

    #alerts .info .icon {
        background: #2BB673
    }

    #alerts .data .icon {
        background: #508CF0
    }

    .message-container .close-button {
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 0;
        margin: 10px 10px 0 0;
    }

    .message-container .button span {
        font-size: 12px;
        color: #444;
    }

    .message-container .message {
        padding: 0 60px 0 20px;
        min-width: 200px;
        color: #444;
        font-weight: 700;
    }
</style>