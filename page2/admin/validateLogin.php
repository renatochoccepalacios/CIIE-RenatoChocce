<?php

$user = isset($_GET['user']) ? $_GET['user'] : '';

if ($user != '') {
    session_start();

    $_SESSION['user'] = $user;

    if ($user == '1') {
        $_SESSION['tipoCuenta'] = 3;
    } else {
        $_SESSION['tipoCuenta'] = 2;
    }

    if (isset($_SESSION['source'])) {
        print_r($_SESSION['source']);
        // exit();
        header('Location: ' . $_SESSION['source']);
    } else {
        header('Location: ../admin/');
    }
} else {
    header('Location: ../admin/');
}