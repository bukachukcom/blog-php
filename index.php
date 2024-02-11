<?php
// Устанавливаем отладку, чтобы видеть ошибки в браузере
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'config/config.php';
require_once 'config/router.php';
require_once 'functions/helpers.php';

$dsn = "mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

// Здесь скорее всего нужно поменять на $_REQUEST (в этот массив приходят данные и из POST и GET, нужно заменить и проверить что все работает)
if (isset($_REQUEST['act'])) {
    if (!empty($routers[$_REQUEST['act']])) {
        require_once $routers[$_REQUEST['act']];
    }
    die();
}

$user = null;
$userId = (int)($_SESSION['userId'] ?? null);
if ($userId) {
    $stmt = $pdo->prepare("SELECT * from user WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
}

$stmt = $pdo->query("SELECT * from article ORDER BY id DESC LIMIT 9");

require_once 'templates/index.php';
