<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoList;
use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function home(Request $request): RedirectResponse
    {
        if ($request->session()->exists('user')) {
            return redirect('/todolist');
        } else {
            return redirect('/login');
        }
    }

    public function toDoList(): Response
    {
        return response()->view('todolistPage.todolist', [
            'title' => 'To Do List',
            'list' => $this->todolistService->viewData()
        ]);
    }

    public function addToDoList(StoreTodoList $request): RedirectResponse
    {
        $data = $request->validated('todo');
        $this->todolistService->addData($data);
        return redirect('/');
    }

    public function deleteToDoList($id): RedirectResponse
    {
        $this->todolistService->deleteData($id);
        return redirect('/');
    }
}
