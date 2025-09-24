<?php
namespace App\Core;

class Router {
    private $routes = [];
    public function add($method, $path, $callable) {
        $this->routes[] = [strtoupper($method), $path, $callable];
    }
    public function dispatch(Request $request) {
        foreach ($this->routes as [$m, $p, $c]) {
            if ($m !== $request->method) continue;
            $pattern = '@^' . preg_replace('@:([\w]+)@', '(?P<$1>[^/]+)', $p) . '$@';
            if (preg_match($pattern, $request->path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                if (is_callable($c)) return call_user_func($c, $request, $params);
                if (is_string($c)) {
                    [$class, $method] = explode('@', $c);
                    $obj = new $class();
                    return call_user_func([$obj, $method], $request, $params);
                }
            }
        }
        http_response_code(404);
        return view('errors/404');
    }
}
