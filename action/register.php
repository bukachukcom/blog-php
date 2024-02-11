<?php
/**
 * @var $pdo
 */
if (count($_POST) > 0) {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $password2 = $_POST['password2'] ?? null;

    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user SET email = ?, password = ?");
    $stmt->execute([$email, $password]);
    redirect('/?act=login');
}

require_once 'templates/register.php';
