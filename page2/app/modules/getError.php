<?php

function getError(string $codigo): void
{
    if (isset($codigo)) {
        setcookie('ERROR', $codigo, time() + 30, "/");
    }
}