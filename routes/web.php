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

Route::get('/', function () {
    return view('welcome');
});

/* Users */

Route::resource('users', 'UserController');

/* Nested CRUD Quiz x Questions */

Route::resource('quizzes', 'QuizController');
Route::resource('quizzes.questions', 'QuestionController');

/* Quiz Taking (Done by Users themselves) */ 

Route::get('take_quizzes', 'QuizController@take_quizzes'); // Where users take their quizzes
Route::get('quizzes/{quiz}/take', 'QuizController@take'); // For storing test results
Route::post('quizzes/{quiz}/record', 'QuizController@record'); // For storing test results

/* Nested CRUD Assessment x Assessment_Items */
Route::resource('assessments', 'AssessmentController');
Route::resource('assessments.assessment_items', 'Assessment_ItemController');

/* Assessment Taking (Done by Bosses) */

Route::get('take_assessments', 'AssessmentController@take_assessments'); // Where users take their assessments
Route::get('assessments/{assessment}/take', 'AssessmentController@take'); // For storing test results
Route::post('assessments/{assessment}/record', 'AssessmentController@record'); // For storing test results

Route::get('see_assessments', 'AssessmentController@see_assessments'); // Where users take their assessments


/* Training
*/

Route::resource('training_sessions', 'TrainingSessionController');
Route::resource('skills', 'SkillController');

/*Auth
*/
Auth::routes();

