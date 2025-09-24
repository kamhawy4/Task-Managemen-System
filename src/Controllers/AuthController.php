<?php
namespace App\Controllers;

use App\Services\AuthService;
use App\Repositories\UserRepository;

class AuthController {
    private $auth;
    private $users;
    public function __construct(){ $this->auth = new AuthService(); $this->users = new UserRepository(); }

    public function showRegister() { return view('auth/register'); }
    public function register($request) {
        verify_csrf();
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pass = $_POST['password'] ?? '';
        if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($pass) < 6) {
            return view('auth/register', ['error'=>'Validation failed']);
        }
        if ($this->users->findByEmail($email)) return view('auth/register', ['error'=>'Email exists']);
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $this->users->create(['name'=>$name,'email'=>$email,'password'=>$hash]);
        header('Location: /login'); exit;
    }
    public function showLogin() { return view('auth/login'); }
    public function login($request) {
        verify_csrf();
        $email = $_POST['email'] ?? ''; $pass = $_POST['password'] ?? '';
        if ($this->auth->attempt($email, $pass)) { header('Location: /tasks'); exit; }
        return view('auth/login', ['error'=>'Invalid credentials']);
    }
    public function logout() { $this->auth->logout(); header('Location: /login'); exit; }
}
