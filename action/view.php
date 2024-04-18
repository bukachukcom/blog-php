<?php
/**
 * @var $pdo
 */
$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

$key = 'news-' . $id;
if (!isset($_COOKIE[$key]) || !$_COOKIE[$key]) {
    setcookie($key, 1, time() + 86400, "/");
    $stmt = $pdo->prepare("UPDATE article SET views = views + 1 WHERE id = ?");
    $stmt->execute([$id]);
}

$stmtComment = $pdo->prepare("SELECT c.*, u.* FROM comment c LEFT JOIN user u ON u.id = c.userId WHERE c.articleId = ? AND c.isActive = 1");
$stmtComment->execute([$id]);

if (count($_POST)) {
    $comment = $_POST['comment'];
    $user = getUser($pdo);
    $userId = $user['id'] ?? null;
    $isActive = $userId ? 1 : 0;
    $stmtAddComment = $pdo->prepare("INSERT INTO comment SET userId = ?, articleId = ? ,content = ?, isActive = ?, createdAt = NOW()");
    $stmtAddComment->execute([$userId, $id, $comment, $isActive]);

    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$article['userId']]);
    $creator = $stmt->fetch();

    $client = new WebSocket\Client("ws://localhost:8081");
    $client->text(json_encode(
        [
            'email' => $creator['email'],
            'data' => [
                'id' => $creator['email'],
                'title' => $article['title'],
                'commenter' => $user['email'],
            ]
        ]
    ));
    $client->close();

    redirect('/?act=view&id=' . $id);
}

require_once 'templates/view.php';
