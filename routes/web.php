<?php
use Illuminate\Support\Facades\Route;
use Nuwave\Lighthouse\Support\Facades\GraphQL;
use Livewire\Volt\Volt;

Route::post('graphql', function () {
    return GraphQL::executeQuery();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/todos', function () {
    return view('todos');
});
Route::get('/notes', function () {
    return view('notes');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/change-todo/{id}', function (string $id) {
    return view('change-todo', ['id' => $id]);
});
