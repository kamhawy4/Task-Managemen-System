<?php
namespace App\Repositories;

use App\Core\Database;
use App\Models\User;
use PDO;

class UserRepository implements RepositoryInterface {
    public function findByEmail($email) {
        $stmt = Database::pdo()->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email'=>$email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        $u = new User();
        foreach ($data as $k=>$v) $u->$k = $v;
        return $u;
    }
    public function create($data) {
        $stmt = Database::pdo()->prepare('INSERT INTO users (name,email,password,created_at) VALUES (:name,:email,:password,NOW())');
        $stmt->execute($data);
        return Database::pdo()->lastInsertId();
    }
    public function find($id) {
        $stmt = Database::pdo()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id'=>$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;
        $u = new User(); foreach ($data as $k=>$v) $u->$k = $v; return $u;
    }
    public function all($limit = 100, $offset = 0) {}
}
