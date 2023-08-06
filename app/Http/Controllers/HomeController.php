<?php

namespace App\Http\Controllers;

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

    public function addToDoList(Request $request): RedirectResponse
    {
        $data = $request->input('todo');
        $this->todolistService->addData($data);
        return redirect('/');
    }

    public function deleteToDoList($id): RedirectResponse
    {
        $this->todolistService->deleteData($id);
        return redirect('/');
    }
}
