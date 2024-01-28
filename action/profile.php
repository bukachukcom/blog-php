<?php
/**
 * @var $mysqli
 */
$user = checkUser($mysqli);

if (count($_POST)) {
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $about = $_POST['about'] ?? null;
    $mysqli->query("UPDATE user SET name = '" . $name . "', surname = '" . $surname . "', phone = '" . $phone . "', about = '" . $about . "' WHERE id = ". $user['id']);
    header('Location: /?act=profile');
    die();
}

require_once 'templates/profile.php';
