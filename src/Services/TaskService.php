<?php
namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService {
    private $tasks;
    public function __construct(){ $this->tasks = new TaskRepository(); }
    public function paginateForUser($userId, $page = 1, $per = 5) {
        $offset = ($page-1)*$per;
        $rows = $this->tasks->all($per, $offset, $userId);
        return $rows;
    }
}
