<?php

function setInfo(string $codigo): string
{
    $error = "";

    if (isset($codigo)) {
        setcookie('INFO', $codigo, time() + 30, "/");
    } else {
        $error = "Indefinido";
    }

    return $error;
}