<?php
/**
 * @var $mysqli
 */
$user = checkUser($mysqli);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: /?act=articles');
    die();
}

if (count($_POST)) {
    $sql = '';
    if ($_FILES['file']['size']) {
        $filename = upload($user['id']);
        $sql = "img = '" . $filename . "', ";
        $article = getUserArticle($mysqli, $id, $user['id']);
        @unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $article['img']);
    }
    $title = strip_tags($_POST['title'] ?? null);
    $content = strip_tags($_POST['content'] ?? null);
    $mysqli->query("UPDATE article SET " . $sql . "title = '" . $title . "', content = '" . $content . "' WHERE id = " . $id . " AND userId = " . $user['id']);
    header('Location: /?act=articles');
    die();
}

$result = $mysqli->query("SELECT * from article WHERE id = '" . $id . "' AND userId = " . $user['id'] . " LIMIT 1");
$article = $result->fetch_assoc();
if (!$article) {
    header('Location: /?act=articles');
    die();
}

require_once 'templates/edit.php';
