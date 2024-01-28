<?php
/**
 * @var $mysqli
 */
if (count($_POST) > 0) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password2 = $_POST['password2'] ?? null;

    $password = password_hash($password, PASSWORD_DEFAULT);

    $mysqli->query("INSERT INTO user SET email = '" . $email . "', password = '" . $password . "'");
    header('Location: /?act=login');
    die();
}

require_once 'templates/register.php';
