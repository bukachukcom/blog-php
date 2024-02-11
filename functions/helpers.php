<?php
function redirect(string $uri): void
{
    header('Location: ' . $uri);
    die();
}

function checkUser($pdo): array
{
    if (empty($_SESSION['userId'])) {
        redirect('/?act=login');
    }
    $userId = (int)$_SESSION['userId'];
    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if (!$user) {
        redirect('/?act=login');
    }

    return $user;
}

function getUser($pdo): array
{
    $userId = (int)($_SESSION['userId'] ?? null);
    if (!$userId) {
        return [];
    }

    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if (!$user) {
        return [];
    }

    return $user;
}

function getUserArticle($pdo, int $id, array $user): array
{
    if ($user['isAdmin'] == 1) {
        $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM article WHERE id = ? AND userId = ?");
        $stmt->execute([$id, $user['id']]);
    }

    $article = $stmt->fetch();
    if (!$article) {
        redirect('/?act=articles');
    }

    return $article;
}

function upload(int $userId): string
{
    $img = $_FILES['file']['tmp_name'];
    $size_img = getimagesize($img);
    $width = $size_img[0];
    $height = $size_img[1];
    $mime = $size_img['mime'];

    switch ($size_img['mime']) {
        case 'image/jpeg':
            $src = imagecreatefromjpeg($img);
            $ext = "jpg";
            break;
        case 'image/gif':
            $src = imagecreatefromgif($img);
            $ext = "gif";
            break;
        case 'image/png':
            $src = imagecreatefrompng($img);
            $ext = "png";
            break;
    }

    $wNew = 348;
    $hNew = floor($height / ($width / $wNew));
    $dest = imagecreatetruecolor($wNew, $hNew);

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $wNew, $hNew, $width, $height);

    $filename = "photo-" . $userId . "-" . time() . '.' . $ext;
    $fullFilename = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $filename;

    switch ($mime) {
        case 'image/jpeg':
            imagejpeg($dest, $fullFilename, 100);
            break;
        case 'image/gif':
            imagegif($dest, $fullFilename);
            break;
        case 'image/png':
            imagepng($dest, $fullFilename);
            break;
    }

    return $filename;
}