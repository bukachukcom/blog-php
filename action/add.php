<?php
/**
 * @var $mysqli
 */
$user = checkUser($mysqli);
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

        $mysqli->query("INSERT INTO article SET img = '" . $filename . "', userId = " . $user['id'] . ", title = '" . $title . "', content = '" . $content . "', createdAt = NOW()");
        header('Location: /?act=articles');
        die();
    }
}

require_once 'templates/add.php';
