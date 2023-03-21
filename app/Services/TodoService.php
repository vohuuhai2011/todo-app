<?php

namespace App\Services;

use App\Repositories\TodoRepository;

class TodoService
{

    private $todoRepository;

    public function __construct(TodoRepository $todoRepository) 
    {
        $this->todoRepository = $todoRepository;
    }


    public function findAll()
    {
        return $this->todoRepository->getAll();
    }

    public function create($todo) 
    {
        $this->todoRepository->create($todo);
    }

    public function getById($id)
    {
        return $this->todoRepository->find($id);
    }

    public function updateById($todo, $updated)
    {
        return $this->todoRepository->update($todo, $updated);
    }

    public function deleteById($id)
    {
        return $this->todoRepository->delete($id);
    }
}
