<?php
/**
 * @var $pdo
 */
$id = (int)$_GET['id'];
$key = 'news-likes-' . $id;
$ip = getClientIP();

$stmt = $pdo->prepare("SELECT COUNT(*) AS numberOfLikes FROM likes WHERE ip = ? AND articleId = ? AND createdAt >= '" . date('Y-m-d H:i:s', time() - 86400) . "'");
$result = $stmt->execute([$ip, $id]);
$likes = $stmt->fetchAll();

$numberOfLikes = $likes[0]['numberOfLikes'] ?? 0;
if (!$numberOfLikes) {
    $stmt = $pdo->prepare('INSERT INTO likes SET userId = ?, ip = ?, articleId = ?, createdAt = NOW(), updateAt = NOW()');
    $stmt->execute([$_SESSION['userId'] ?? null, $ip, $id]);

    if (!isset($_COOKIE[$key]) || !$_COOKIE[$key]) {
        setcookie($key, 1, time() + 86400, "/");
        $stmt = $pdo->prepare("UPDATE article SET `likes` = `likes` + 1 WHERE id = ?");
        $stmt->execute([$id]);
    }
}

$stmt = $pdo->prepare("SELECT * FROM article WHERE id = ? LIMIT 1");
$stmt->execute([$id]);

echo json_encode(['numberOfLikes' => $numberOfLikes]);
