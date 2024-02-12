<?php
// Устанавливаем отладку, чтобы видеть ошибки в браузере
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/router-admin.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/helpers.php';

$dsn = "mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

/**
 * @var $pdo
 */
$user = checkAdminUser($pdo);

if (isset($_REQUEST['act']) && !empty($routersAdmin[$_REQUEST['act']])) {
    require_once $routersAdmin[$_REQUEST['act']];
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/action/admin/index.php';
}
