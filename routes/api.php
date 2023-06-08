<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\FAQController;
use App\Http\Controllers\Api\FooterLinkController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::get('article', [ArticleController::class, 'index'])->name('article.index');
Route::post('search', [ArticleController::class, 'search'])->name('article.search');


Route::get('category', [CategoryController::class, 'index']);

Route::get('footer-links', [FooterLinkController::class, 'index']);

Route::get('FAQ', [FAQController::class, 'index']);

Route::post('contact', [ContactController::class, 'store']);