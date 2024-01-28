<?php
/**
 * @var $mysqli
 */

$error = '';
if (count($_POST) > 0) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $result = $mysqli->query("SELECT * from user WHERE email = '" . $email . "'");
    $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userId'] = $user['id'];
        header('Location: /?act=profile');
        die();
    } else {
        $error = 'User is not found';
    }
}

require_once 'templates/login.php';
