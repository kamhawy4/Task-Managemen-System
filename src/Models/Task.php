<?php
namespace App\Models;

class Task {
    public $id;
    public $user_id;
    public $title;
    public $description;
    public $status;
    public $due_date;
    public $created_at;
}
