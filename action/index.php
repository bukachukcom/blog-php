<?php
$user = null;
$userId = (int)($_SESSION['userId'] ?? null);
if ($userId) {
    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
}

$stmt = $pdo->query("SELECT * from article WHERE isPublished = 1 ORDER BY id DESC LIMIT 9");

require_once 'templates/index.php';
