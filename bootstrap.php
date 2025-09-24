<?php
// bootstrap.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Basic error logging
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/storage/logs/app.log');

require __DIR__ . '/src/Core/Autoloader.php';
$loader = new App\Core\Autoloader();
$loader->register();

// Load config
$config = require __DIR__ . '/config/config.php';

// Simple helper to render views
function view($path, $data = []) {
    extract($data);
    $file = __DIR__ . '/views/' . $path . '.php';
    if (!file_exists($file)) return '';
    ob_start();
    include $file;
    return ob_get_clean();
}

// csrf helpers
function csrf_token() {
    if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['_csrf'];
}
function csrf_field() {
    $t = csrf_token();
    return '<input type="hidden" name="_csrf" value="' . htmlspecialchars($t) . '">';
}
function verify_csrf() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post = $_POST['_csrf'] ?? '';
        if (!hash_equals($_SESSION['_csrf'] ?? '', $post)) {
            throw new Exception('Invalid CSRF token');
        }
    }
}

// DB connection singleton
use App\Core\Database;
Database::init($config['db']);

// Simple auth helper
use App\Services\AuthService;
$auth = new AuthService();

?>
