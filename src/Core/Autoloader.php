<?php
namespace App\Core;

class Autoloader {
    public function register() {
        spl_autoload_register([$this, 'load']);
    }
    public function load($class) {
        $prefix = 'App\\';
        if (strpos($class, $prefix) !== 0) return;
        $relative = substr($class, strlen($prefix));
        $path = __DIR__ . '/../' . str_replace('\\', '/', $relative) . '.php';
        if (file_exists($path)) require $path;
    }
}
