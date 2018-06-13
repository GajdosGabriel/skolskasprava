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


Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

// oAuth Routes...
Route::get('/auth/{service}', 'Auth\AuthController@redirectToProvider')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');
Route::get('/auth/{service}/callback', 'Auth\AuthController@handleProviderCallback')
    ->where('service', '(github|facebook|google|twitter|linkedin|bitbucket)');

Route::get('parentlogin/{user}/{slug}/{token}/parentlogin', 'Auth\AuthController@checkParentLogin')->name('parent.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/user', 'UsersController@start');
    Route::get('/worker', 'WorkersController@start')->name('worker');

    Route::get('trieda/{grade}', 'GradesController@show')->name('grades.show');
    Route::get('trieda/{grade}/edit', 'GradesController@edit')->name('grades.edit');
    Route::post('trieda/{grade}', 'GradesController@update')->name('grades.update');

    Route::get('{user}/{slug}', 'UsersController@show')->name('user.show');
    Route::get('{user}/{slug}/edit', 'UsersController@edit')->name('user.edit');
    Route::get('{user}/{slug}/sendInvitation', 'UsersController@sendInvitation')->name('user.sendInvitation');
    Route::get('{user}/{slug}/parentInvitation', 'UsersController@sendParentInvitation')->name('user.sendParentInvitation');
    Route::post('{user}/{slug}/update', 'UsersController@update')->name('user.update');

    Route::get('ucitelia', 'WorkersController@index')->name('workers.index')->middleware('workers');
    Route::get('students', 'StudentsController@index')->name('students.index');

    Route::get('student/{user}/{slug}', 'StudentsController@show')->name('students.show');
    Route::get('student/{user}/{slug}/edit', 'StudentsController@edit')->name('students.edit');
    Route::get('student/{user}/{slug}/delete', 'StudentsController@destroy')->name('students.destroy');
    Route::get('student/{user}/agreemend/{agreemend}', 'AgreementsController@addAgreemend')
                                            ->name('students.agreement');

    Route::post('students/store', 'StudentsController@store')->name('students.store');
    Route::post('students/{user}/{slug}/update', 'StudentsController@update')->name('students.update');
    Route::post('students/{user}/addParent', 'StudentsController@addParentForStudent')->name('students.add.parent');

    Route::get('student/{user}/{slug}/print', 'AgreementsController@showPdf')->name('agreement.show');


    Route::get('rodicia', 'ParentsController@index')->name('folks.index');
    Route::get('rodic/{user}/{slug}', 'ParentsController@show')->name('folks.show');
    Route::post('rodicianew', 'ParentsController@store')->name('parents.store');


    Route::get('triedy', 'GradesController@index')->name('grades.index')->middleware('workers');

    Route::post('triedanew/', 'GradesController@store')->name('grades.store');
    Route::get('{user}/{slug}/destroy/{grade}', 'GradesController@destroy')->name('grades.destroy');


    //    Staff
    Route::post('workernew', 'WorkersController@store')->name('worker.store');
    Route::get('delete/{user}/{slug}', 'WorkersController@destroy')->name('worker.destroy');


    Route::get('messenger', 'MessengersController@index')->name('messenger.index');
    Route::get('messenger/{user}/{slug}', 'MessengersController@show')->name('messenger.show');
    Route::post('messenger/{user}', 'MessengersController@store')->name('messenger.store');

    Route::middleware(['admin'])->group(function () {
        Route::get('administrator', 'AdministratorController@index')->name('administrator.index');
    });


    Route::get('add/missing/data', 'TutorialController@missingData')->name('tutorial.missingData');
    Route::get('/add/create/grade', 'TutorialController@addGrade')->name('tutorial.addGrade');
    Route::get('/add/create/student', 'TutorialController@addStudent')->name('tutorial.addStudent');
    Route::get('/add/create/parent', 'TutorialController@addParent')->name('tutorial.addParent');



});

