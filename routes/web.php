<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

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

Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "submitLogin"]);
Route::get("/daftar", [AuthController::class, "register"]);
Route::post("/daftar", [AuthController::class, "submitRegister"]);
Route::get("/logout", [AuthController::class, "logout"])->name("logout")->middleware("isLogin");

Route::get("/", [PollController::class, "index"])->middleware("isLogin");
Route::get("/poll/create", [PollController::class, "create"])->middleware("isAdmin");
Route::get("/poll/{poll_id}", [PollController::class, "detailPoll"])->middleware("isLogin");
Route::post("/poll/{poll_id}", [PollController::class, "makeAVote"])->middleware("isLogin");
Route::post("/poll", [PollController::class, "submitPoll"])->middleware("isAdmin");
Route::delete("/poll/{poll_id}", [PollController::class, "deletePoll"])->middleware("isAdmin");

Route::get("/user", [UserController::class, "index"])->middleware("isAdmin");
Route::get("/vote", [VoteController::class, "index"])->middleware("isAdmin");
