<?php


if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

session_start();


session_unset();
session_destroy();


header("Location: login.php");

exit;