<?php
// Устанавливаем отладку, чтобы видеть ошибки в браузере
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'config/config.php';
require_once 'config/router.php';
require_once 'functions/helpers.php';

require_once 'lib/PHPMailer/src/Exception.php';
require_once 'lib/PHPMailer/src/PHPMailer.php';
require_once 'lib/PHPMailer/src/SMTP.php';

$dsn = "mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, DB_USER, DB_PASSWORD, $options);

if (isset($_REQUEST['act']) && !empty($routers[$_REQUEST['act']])) {
    require_once $routers[$_REQUEST['act']];
} else {
    require_once 'action/index.php';
}
