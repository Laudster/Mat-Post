<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Models\User;
use App\Models\Post;

Route::get('/', function () {
    return view('index', ["posts" => Post::all()]);
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::post("/post", [PostController::class, "createPost"]);

Route::delete("/logout", [UserController::class, "logout"]);
Route::delete("/slett-bruker", [UserController::class, "slettBruker"]);