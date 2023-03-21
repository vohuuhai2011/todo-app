<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;
use App\Services\TodoService;

class TodosController extends Controller
{
    
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $result = $this->todoService->findAll();
        return view('home', ['todos' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'todo-title' => 'required|max:100',
            'todo-description' => 'required|max:5000',
        ]);
        // Create new todo
        $data['title'] = $request['todo-title'];
        $data['description'] = $request['todo-description'];
        // Create new todo data
        $this->todoService->create($data);
        // Redirect to home
        return redirect('/');
    }

    public function getDataActiveByPage($page = 1)
    {
        $todo = new Todos();
        $result = $todo->where('status', '=', 'ACTIVE')->forPage($page, 10)->get();
        return view('active', ['todos' => $result, 'page' => $page]);
    }

    public function getDataDoneByPage($page = 1)
    {
        $todo = new Todos();
        $result = $todo->where('status', '=', 'DONE')->forPage($page, 10)->get();
        return view('done', ['todos' => $result, 'page' => $page]);
    }

    public function getDataDeletedByPage($page = 1)
    {
        $todo = new Todos();
        $result = $todo->where('status', '=', 'DELETED')->forPage($page, 10)->get();
        return view('deleted', ['todos' => $result, 'page' => $page]);
    }

    public function getTodoById($id)
    {
        $result = $this->todoService->getById($id);
        return view('edit', ['todo' => $result]);
    }

    public function updateTodoById($id, Request $request)
    {
        // Validate the request
        $request->validate([
            'todo-title' => 'required|max:100',
            'todo-description' => 'required|max:5000',
            'todo-status' => 'required'
        ]);

        // Find todo by id
        $result = $this->todoService->getById($id);

        $updated['title'] = $request['todo-title'];
        $updated['description'] = $request['todo-description'];
        $updated['status'] = $request['todo-status'];

        // Update todo by id
        $this->todoService->updateById($result, $updated);

        // redirect to todo/id page
        return redirect('/');
    }

    public function deleteTodoById($id, Request $request)
    {
        // Delete todo by id
        $this->todoService->deleteById($id);
        return redirect('/');
    }
}
