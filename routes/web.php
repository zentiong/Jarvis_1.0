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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');

/* Nested CRUD
*/
Route::resource('quizzes', 'QuizController');
Route::resource('quizzes.questions', 'QuestionController');

/* Quiz Taking
*/

Route::get('quizzes/{quiz}/take', 'QuizController@take');
Route::post('quizzes', 'QuizController@record');


Route::resource('training_sessions', 'TrainingSessionController');

Auth::routes();

