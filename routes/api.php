<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Post\IndexController;
use App\Http\Controllers\Api\Post\ShowController;
use App\Http\Controllers\Api\Post\CreateController;
use App\Http\Controllers\Api\Post\PostCommentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('posts')->group(function () {
    Route::get('/', IndexController::class)->name('posts.index');
    Route::post('/', CreateController::class)->name('posts.create')->middleware('auth:sanctum');
    Route::get('/{id}', ShowController::class)->name('posts.show');
    Route::post('/{id}/comments', PostCommentController::class)->name('comment.create')->middleware('auth:sanctum');

});