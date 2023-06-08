<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api\/)(?!admin\/)[\/\w\.\,-]*'); //when route doesn't start with api/ return the welcome view

/* Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'setlocale'
], function () {
    Route::get('/{any?}', function () {
        return view('welcome');
    })->where('any', '^(?!api\/)[\/\w\.\,-]*'); //when route doesn't start with api/ return the welcome view
    
    Route::post('suggestion', [\App\Http\Controllers\SearchController::class, 'index'])->name('autocomplete.index');
}); */

Route::get('/', function () {
    return redirect(app()->getLocale());
});
Route::get('suggestion', [\App\Http\Controllers\SearchController::class, 'search'])->name('autocomplete');
Route::get('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'getLogin'])->name('adminLogin');
Route::post('admin/login', [\App\Http\Controllers\Admin\AuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('admin/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('adminLogout');

Route::group(['prefix' => 'admin', 'middleware' => 'adminauth'], function () {
    // Admin Dashboard
    Route::get('dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
});
