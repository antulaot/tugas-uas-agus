<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setSession($key, $value) {
    $_SESSION[$key] = $value;
}

function getSession($key) {
    return $_SESSION[$key] ?? null;
}
