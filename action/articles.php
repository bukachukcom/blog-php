<?php
/**
 * @var $pdo
 */
$user = checkUser($pdo);

$stmt = $pdo->prepare("SELECT * from article WHERE userId = ? ORDER BY id DESC");
$stmt->execute([$user['id']]);

require_once 'templates/articles.php';
