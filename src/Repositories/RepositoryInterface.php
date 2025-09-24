<?php
namespace App\Repositories;

interface RepositoryInterface {
    public function find($id);
    public function all($limit = 100, $offset = 0);
}
