<?php
namespace App\Core;

use PDO;

class Database {
    private static $pdo;
    public static function init($config) {
        if (self::$pdo) return;
        $dsn = $config['dsn'];
        $user = $config['user'];
        $pass = $config['pass'];
        $opts = $config['options'] ?? [];
        self::$pdo = new PDO($dsn, $user, $pass, $opts);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function pdo() {
        return self::$pdo;
    }
}
