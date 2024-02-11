<?php
/**
 * @var $pdo
 */
$user = checkUser($pdo);

$stmt = $pdo->prepare("SELECT * from article ORDER BY id DESC");
$stmt->execute();

require_once 'templates/articles.php';
