<?php
namespace App\Services;

use App\Repositories\UserRepository;

class AuthService {
    private $users;
    public function __construct() {
        $this->users = new UserRepository();
    }
    public function attempt($email, $password) {
        $user = $this->users->findByEmail($email);
        if (!$user) return false;
        if (password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            return true;
        }
        return false;
    }
    public function user() {
        if (empty($_SESSION['user_id'])) return null;
        return $this->users->find($_SESSION['user_id']);
    }
    public function logout() { unset($_SESSION['user_id']); }
}
