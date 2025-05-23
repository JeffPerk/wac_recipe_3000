<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/recipes/search', [RecipeController::class, 'search']);
Route::get('/recipes', [RecipeController::class, 'index']);
Route::get('/recipes/{slug}', [RecipeController::class, 'show']);
