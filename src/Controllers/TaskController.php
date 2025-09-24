<?php
namespace App\Controllers;

use App\Services\AuthService;
use App\Repositories\TaskRepository;
use App\Services\TaskService;

class TaskController {
    private $auth; private $tasks; private $service;
    public function __construct(){ $this->auth = new AuthService(); $this->tasks = new TaskRepository(); $this->service = new TaskService(); }

    private function ensureAuth() {
        if (!$this->auth->user()) { header('Location: /login'); exit; }
    }

    public function index($request) {
        $this->ensureAuth();
        $page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
        $rows = $this->service->paginateForUser($_SESSION['user_id'], $page, 5);
        return view('tasks/index', ['tasks'=>$rows, 'page'=>$page]);
    }
    public function create($request) {
        $this->ensureAuth();
        return view('tasks/create');
    }
    public function store($request) {
        $this->ensureAuth(); verify_csrf();
        $data = [
            'user_id'=>$_SESSION['user_id'],
            'title'=>$_POST['title'] ?? '',
            'description'=>$_POST['description'] ?? '',
            'status'=>$_POST['status'] ?? 'pending',
            'due_date'=>$_POST['due_date'] ?? null
        ];
        if (!$data['title']) return view('tasks/create', ['error'=>'Title required']);
        $this->tasks->create($data);
        header('Location: /tasks'); exit;
    }
    public function edit($request, $params) {
        $this->ensureAuth();
        $id = $params['id'];
        $task = $this->tasks->find($id);
        if (!$task || $task['user_id'] != $_SESSION['user_id']) {
            http_response_code(403);
            return 'Forbidden';
        }
        return view('tasks/edit', ['task'=>$task]);
    }
    public function update($request, $params) {
        $this->ensureAuth(); verify_csrf();
        $id = $params['id']; $task = $this->tasks->find($id);
        if (!$task || $task['user_id'] != $_SESSION['user_id']) { http_response_code(403); return 'Forbidden'; }
        $data = ['title'=>$_POST['title'],'description'=>$_POST['description'],'status'=>$_POST['status'],'due_date'=>$_POST['due_date']];
        $this->tasks->update($id, $data);
        header('Location: /tasks'); exit;
    }
    public function destroy($request, $params) {
        $this->ensureAuth(); verify_csrf();
        $id = $params['id']; $task = $this->tasks->find($id);
        if (!$task || $task['user_id'] != $_SESSION['user_id']) { http_response_code(403); return 'Forbidden'; }
        $this->tasks->delete($id);
        header('Location: /tasks'); exit;
    }
}
