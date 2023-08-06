<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use App\Models\Todolist;

class TodolistServiceImpl implements TodolistService
{
    function addData(string $data)
    {
        Todolist::create([
            'lists' => $data
        ]);
    }

    public function viewData()
    {
        $lists = Todolist::get();
        return $lists;
    }

    public function deleteData(string $data)
    {
        Todolist::find($data)->delete();
    }
}
