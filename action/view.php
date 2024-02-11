<?php
/**
 * @var $pdo
 */
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

$stmtComment = $pdo->prepare("SELECT c.*, u.* FROM comment c LEFT JOIN user u ON u.id = c.userId WHERE c.articleId = ? AND c.isActive = 1");
$stmtComment->execute([$id]);

if (count($_POST)) {
    $comment = $_POST['comment'];
    $user = getUser($pdo);
    $userId = $user['id'] ?? null;
    $isActive = $userId ? 1 : 0;
    $stmtAddComment = $pdo->prepare("INSERT INTO comment SET userId = ?, articleId = ? ,content = ?, isActive = ?, createdAt = NOW()");
    $stmtAddComment->execute([$userId, $id, $comment, $isActive]);
    redirect('/?act=view&id=' . $id);
}

require_once 'templates/view.php';
