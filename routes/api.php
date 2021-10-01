<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Panel;
use App\Http\Controllers\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/panel/artisan', [Panel::class, "artisan"]);
Route::get('/panel/executor', [Panel::class, "executor"]);

Route::post('/auth/register', [Authentication::class, "register"]);
Route::post('/auth/login', [Authentication::class, "login"]);
Route::post('/auth/logout', [Authentication::class, "logout"]);
Route::get('/user', [Authentication::class, "user"]);
Route::post('/user', [Authentication::class, "userAction"]);
Route::get('/users', [Authentication::class, "users"]);

Route::get('/story/{story_id}', [Story::class, "story"]);
Route::post('/story/{story_id}', [Story::class, "storyAction"]);
Route::get('/stories', [Story::class, "stories"]);
Route::get('/stories/recomendation', [Story::class, "recomended_story"]);

Route::any('/{r?}', function(){
    return response()->json([
        "code" => 404,
        "status" => "not found"
    ], 404);
})->where('r', '.*');
