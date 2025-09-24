<?php
namespace App\Repositories;

use App\Core\Database;
use App\Models\Task;
use PDO;

class TaskRepository implements RepositoryInterface {
    public function find($id) {
        $stmt = Database::pdo()->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->execute(['id'=>$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }
    public function all($limit = 10, $offset = 0, $userId = null) {
        $sql = 'SELECT * FROM tasks WHERE user_id = :uid ORDER BY created_at DESC LIMIT :lim OFFSET :off';
        $stmt = Database::pdo()->prepare($sql);
        $stmt->bindValue(':uid', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':off', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($data) {
        $sql = 'INSERT INTO tasks (user_id,title,description,status,due_date,created_at) VALUES (:user_id,:title,:description,:status,:due_date,NOW())';
        $stmt = Database::pdo()->prepare($sql);
        $stmt->execute($data);
        return Database::pdo()->lastInsertId();
    }
    public function update($id, $data) {
        $sql = 'UPDATE tasks SET title=:title, description=:description, status=:status, due_date=:due_date WHERE id=:id';
        $stmt = Database::pdo()->prepare($sql);
        $data['id']=$id; $stmt->execute($data);
        return true;
    }
    public function delete($id) {
        $stmt = Database::pdo()->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->execute(['id'=>$id]);
    }
}
