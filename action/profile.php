<?php
/**
 * @var $pdo
 */
$user = checkUser($pdo);

if (count($_POST)) {
    $name = $_POST['name'] ?? null;
    $surname = $_POST['surname'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $about = $_POST['about'] ?? null;
    $stmt = $pdo->prepare("UPDATE user SET name = ?, surname = ?, phone = ?, about = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $phone, $about, $_SESSION['userId']]);
    redirect('/?act=articles');
}

require_once 'templates/profile.php';
