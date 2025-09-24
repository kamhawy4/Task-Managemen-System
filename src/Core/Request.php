<?php
namespace App\Core;

class Request {
    public $method;
    public $path;
    public $get;
    public $post;
    public $server;

    public static function capture() {
        $r = new self();
        $r->method = $_SERVER['REQUEST_METHOD'];
        $r->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $r->get = $_GET;
        $r->post = $_POST;
        $r->server = $_SERVER;
        return $r;
    }
}
