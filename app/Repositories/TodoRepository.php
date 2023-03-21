<?php

namespace App\Repositories;

use App\Models\Todos;

class TodoRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Todos::class;
    }
}