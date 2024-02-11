<?php
/**
 * @var $pdo
 */
$user = checkUser($pdo);
$error = '';
if (count($_POST)) {
    $title = strip_tags($_POST['title'] ?? null);
    $content = strip_tags($_POST['content'] ?? null);

    if (!$_FILES['file']['size']) {
        $error = 'Image not found';
    } elseif (!$title || !$content) {
        $error = 'Content is not found';
    } else {
        $filename = upload($user['id']);

        $stmt = $pdo->prepare("INSERT INTO article SET img = ?, userId = ?, title = ?, content = ?, createdAt = NOW()");
        $stmt->execute([$filename, $user['id'], $title, $content]);
        redirect('/?act=articles');
    }
}

require_once 'templates/add.php';
