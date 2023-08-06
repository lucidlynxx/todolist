<?php

namespace App\Services;

interface TodolistService

{
    function addData(string $data);
    function viewData();
    function deleteData(string $data);
}
