<?php
/**
 * @var $pdo
 * @var $user array
 */
$id = $_GET['id'] ?? null;
if (!$id) {
    redirect('/admin');
}

if (count($_POST)) {
    $sql = '';
    if ($_FILES['file']['size']) {
        $filename = upload($user['id']);
        $sql = "img = '" . $filename . "', ";
        $article = getUserArticle($pdo, $id, $user);
        @unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);
    }
    $title = strip_tags($_POST['title'] ?? null);
    $content = strip_tags($_POST['content'] ?? null);
    $categoryId = (int)$_POST['categoryId'];
    $categoryId = $categoryId ?: null;
    $isPublished = $_POST['isPublished'] ?? 0;

    $stmt = $pdo->prepare("UPDATE article SET " . $sql . "title = ?, content =  ?, categoryId = ?, isPublished = ? WHERE id = ?");
    $stmt->execute([$title, $content, $categoryId, $isPublished, $id]);

    redirect('/admin');
}

$stmtCategory = $pdo->prepare("SELECT * FROM category ORDER BY name");
$stmtCategory->execute();

$stmt = $pdo->prepare("SELECT * from article WHERE id = ? LIMIT 1");
$stmt->execute([$id]);

$article = $stmt->fetch();
if (!$article) {
    redirect('/admin');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/edit.php';
