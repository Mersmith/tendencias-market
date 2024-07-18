<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/tasks', function (Request $request) {
    $tasks = [
        ['id' => 1, 'title' => 'Task 1', 'description' => 'Do something for Task 1'],
        ['id' => 2, 'title' => 'Task 2', 'description' => 'Complete Task 2 by tomorrow'],
        ['id' => 3, 'title' => 'Task 3', 'description' => 'Prepare presentation slides for Task 3'],
        ['id' => 4, 'title' => 'Task 4', 'description' => 'Review Task 4 requirements'],
        ['id' => 5, 'title' => 'Task 5', 'description' => 'Submit final report for Task 5'],
    ];

    return response()->json($tasks);
});