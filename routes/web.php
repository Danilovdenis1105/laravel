<?php

use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostsController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\RestTestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('blog')->group(function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});

Route::prefix('admin/blog')->group(function () {
    Route::resource('categories', CategoryController::class)
        ->only(['index', 'edit', 'store', 'update', 'create'])
        ->names('blog.admin.categories');
    Route::resource('posts', AdminPostsController::class)
        ->except(['show'])
        ->names('blog.admin.posts');
});

Route::resource('rest', RestTestController::class)->names('restTest');

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('admin');

require __DIR__ . '/auth.php';
