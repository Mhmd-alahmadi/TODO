<?php

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

//use App\Http\Controllers\TaskController;
use App\Http\Controllers\Relation\RelationsController;
// this Route take you to the first page
Route::get('/', function () {
    return view('welcome');
});
// this Route for turn on the verified
Auth::routes(['verify' => true]);

// this Route for all of main operations and embed the mcamara  and auth
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth', 'verified']
], function () {
// this Route take youy to main page and for getting all tasks
    Route::get('home', 'Relation\RelationsController@getTask')->name('home');

// this group for ctreate new task and store
    Route::group(['prefix' => 'task'], function () {
        Route::get('/', [RelationsController::class, 'get'])->name('task.get');
        Route::get('create', [RelationsController::class, 'create'])->name('task.create');
        Route::post('store', [RelationsController::class, 'store'])->name('task.store');
        // this group for delete update  insert and getting the complete task
        Route::group(['prefix' => '{task_id}'], function () {
            Route::get('delete', [RelationsController::class, 'delete'])->name('task.delete');
            Route::get('edit', [RelationsController::class, 'editTask'])->name('task.edit');
            Route::post('update', [RelationsController::class, 'updateTask'])->name('task.update');
            Route::post('checkedUserTask', [RelationsController::class,'postIndex'])->name('send.type');
        });
    });
});
