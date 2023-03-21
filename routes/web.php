<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Middleware\CheckLenght;
use App\Models\Todos;
use Symfony\Component\HttpFoundation\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Get the ACTIVE todo tasks.
 */
Route::get('/', [TodosController::class, 'index']);

/**
 * Create a new todo task.
 */
Route::post('/todo', [TodosController::class, 'store'])->middleware(CheckLenght::class);;

/**
 * Get the ACTIVE todo tasks for a given page.
 */
Route::get('/todo/active/{page?}', [TodosController::class, 'getDataActiveByPage']);

/**
 * Get the DONE todo tasks for a given page.
 */
Route::get('/todo/done/{page?}', [TodosController::class, 'getDataDoneByPage']);

/**
 * Get the DELETED todo tasks for a given page.
 */
Route::get('/todo/deleted/{page?}', [TodosController::class, 'getDataDeletedByPage']);

/**
 * Get a specific todo task by id.
 */
Route::get('/todo/{id}', [TodosController::class, 'getTodoById']);

/**
 * Update a specific todo task by id.
 */
Route::put('/todo/{id}', [TodosController::class, 'updateTodoById']);

/**
 * Delete a specific todo task by id.
 */
Route::delete('/todo/{id}', [TodosController::class, 'deleteTodoById']);






