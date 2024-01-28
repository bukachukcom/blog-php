<?php
// Устанавливаем отладку, чтобы видеть ошибки в браузере
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'config.php';
require_once 'functions/helpers.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Здесь скорее всего нужно поменять на $_REQUEST (в этот массив приходят данные и из POST и GET, нужно заменить и проверить что все работает)
if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'register':
            require_once 'action/register.php';
            break;
        case 'login':
            require_once 'action/login.php';
            break;
        case 'profile':
            require_once 'action/profile.php';
            break;
        case 'add':
            require_once 'action/add.php';
            break;
        case 'articles':
            require_once 'action/articles.php';
            break;
        case 'edit':
            require_once 'action/edit.php';
            break;
        case 'delete':
            require_once 'action/delete.php';
            break;
        case 'logout':
            require_once 'action/logout.php';
            break;
        case 'view':
            require_once 'action/view.php';
            break;
    }
    die();
}

$user = null;
$userId = intval($_SESSION['userId'] ?? null);
if ($userId) {
    $result = $mysqli->query("SELECT * from user WHERE id = '" . $userId . "' LIMIT 1");
    $user = $result->fetch_assoc();
}

$result = $mysqli->query("SELECT * from article ORDER BY id DESC LIMIT 9");

require_once 'templates/index.php';
