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

/* How this thing works:

Route::<method>('<url>', '<function>');

	Methods: Resource / Put / Post / Get

*/

/* Landing Page */


Route::get('/', 'TrainingController@landing');

Route::resource('levels', 'LevelingController');

/* Users */

Route::resource('users', 'UserController');



/* Nested CRUD Quiz x Questions */

Route::resource('quizzes', 'QuizController');
Route::resource('quizzes.questions', 'QuestionController');

/* Sections */ 

Route::get('quizzes/{quiz}/add_section', 'QuestionController@add_section');
Route::post('quizzes/{quiz}/store_section', 'QuestionController@store_section');

Route::post('quizzes/{quiz}/questions/create', 'QuestionController@create');

/* Quiz Taking (Done by Users themselves) */ 

Route::get('take_quizzes', 'QuizController@take_quizzes'); // Where users take their quizzes
Route::get('quizzes/{quiz}/take', 'QuizController@take'); // For storing test results
Route::post('quizzes/{quiz}/record', 'QuizController@record'); // For storing test results

Route::post('verify_pw', 'QuizController@verify_pw'); // For storing test results

Route::get('results', 'QuizController@results');

/* Nested CRUD Assessment x Assessment_Items */
Route::resource('assessments', 'AssessmentController');
Route::resource('assessments.assessment_items', 'Assessment_ItemController');

/* Assessment Taking (Done by Bosses) */

Route::get('make_assessments', 'AssessmentController@make_assessments'); // Where users take their assessments
Route::get('assessments/{assessment}/make', 'AssessmentController@make'); // For storing test results
Route::post('assessments/{assessment}/record', 'AssessmentController@record'); // For storing test results

Route::get('see_assessments', 'AssessmentController@see_assessments'); // Where users see their assessments


/* Training */

Route::resource('trainings', 'TrainingController');

/* Recommmend Trainings */
Route::get('recommend', 'TrainingController@recommend'); // For storing test results
Route::post('recommend_fire', 'TrainingController@fire'); // For storing test results

/* Sign Up */
Route::post('confirm', 'TrainingController@confirm'); // recommended
Route::post('signup', 'TrainingController@signup'); // sariling kusa

/* Skills */
Route::group(['middleware' => 'HR'], function() {
	Route::resource('skills', 'SkillController');
});
    

/* Positions */
Route::group(['middleware' => 'HR'], function() {
	Route::resource('positions', 'PositionController');
});

/* Event */

Route::resource('events', 'EventController');

/*Auth */ 
Auth::routes();


