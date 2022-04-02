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
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});
//
//Auth::routes(['verify'=>true]);
//
//Route::get('/home', 'HomeController@index')->name('home') -> middleware('verified');
//
//
//Route::get('/home', 'HomeController@index')->name('home') -> middleware('verified');
Auth::routes(['verify'=>true]);



Route::group(['prefix' =>LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth','verified']
], function () {





    Route::group([  'prefix' => 'task'],function (){ //'middleware' => '',
        Route::get('user', 'Relation\RelationsController@getTask')->name('home') ;
        Route::get('/', [TaskController::class, 'get'])-> name('task.get');
        Route::get('create',[TaskController::class, 'create'])-> name('task.create');
//        Route::post('store','TaskController@store')->name('task.store');
        Route::post('store',[TaskController::class,'store'])->name('task.store');




        Route::group(['prefix' => '{task_id}'], function() {

//            Route::put('update', [TaskController::class,'update'])->name('task.update');
//            Route::delete('delete', [TaskController::class,'delete'])->name('task.delete');
            Route::get('delete','Relation\RelationsController@delete')->name('task.delete');
            Route::get('edit','Relation\RelationsController@editTask')->name('task.edit');
            Route::post('update','Relation\RelationsController@updateTask')->name('task.update');
        });
        Route::post('checkedUserTask/{task_id}','Relation\RelationsController@postIndex') -> name ('send.type');
    });

});
