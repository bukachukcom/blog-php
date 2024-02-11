<?php
/**
 * @var $pdo
 */
$user = checkUser($pdo);

$id = $_GET['id'] ?? null;
if (!$id) {
    redirect('/?act=articles');
}

$article = getUserArticle($pdo, $id, $user);

@unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);

if ($user['isAdmin']) {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id = ?");
    $stmt->execute([$id]);
} else {
    $stmt = $pdo->prepare("DELETE FROM article WHERE id = ? AND userId = ?");
    $stmt->execute([$id, $user['id']]);
}

if ($user['isAdmin']) {
    redirect('/?act=adminArticles');
} else {
    redirect('/?act=articles');
}

