<?php

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
    return view('workout.top');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/registproject', [App\Http\Controllers\ProjectsController::class, 'RegistProject'])->name('RegistProject')->middleware('auth');
Route::get('/preparationproject', [App\Http\Controllers\ProjectsController::class, 'PreparationProject'])->name('PreparationProject')->middleware('auth');
Route::get('/executionproject', [App\Http\Controllers\ProjectsController::class, 'ExecutionProject'])->name('ExecutionProject')->middleware('auth');
Route::get('/completionproject', [App\Http\Controllers\ProjectsController::class, 'CompletionProject'])->name('CompletionProject')->middleware('auth');
Route::get('/editproject/{id}', [App\Http\Controllers\ProjectsController::class, 'EditProject'])->name('EditProject')->middleware('auth');
Route::post('/changeproject/{id}', [App\Http\Controllers\ProjectsController::class, 'ChangeProject'])->name('ChangeProject')->middleware('auth');
Route::post('/deleteproject/{id}', [App\Http\Controllers\ProjectsController::class, 'DeleteProject'])->name('DeleteProject')->middleware('auth');

Route::get('/selectprolect/{id}', [App\Http\Controllers\WorksController::class, 'SelectProject'])->name('SelectProject')->middleware('auth');
Route::post('/registworks', [App\Http\Controllers\WorksController::class, 'RegistWorks'])->name('RegistWorks')->middleware('auth');
Route::get('/startworks/{id}', [App\Http\Controllers\WorksController::class, 'StartWorks'])->name('StartWorks')->middleware('auth');
Route::get('/endworks/{id}', [App\Http\Controllers\WorksController::class, 'EndWorks'])->name('EndWorks')->middleware('auth');
Route::get('/editworks/{id}', [App\Http\Controllers\WorksController::class, 'EditWorks'])->name('EditWorks')->middleware('auth');
Route::post('/changeworks/{id}', [App\Http\Controllers\WorksController::class, 'ChangeWorks'])->name('ChangeWorks')->middleware('auth');
Route::post('/deleteworks/{id}', [App\Http\Controllers\WorksController::class, 'DeleteWorks'])->name('DeleteWorks')->middleware('auth');

Route::get('/memberlist', [App\Http\Controllers\MembersController::class, 'MemberList'])->name('MemberList')->middleware('auth');
Route::post('/registmember', [App\Http\Controllers\MembersController::class, 'RegistMember'])->name('RegistMember')->middleware('auth');
Route::get('/editmember/{id}', [App\Http\Controllers\MembersController::class, 'EditMember'])->name('EditMember')->middleware('auth');
Route::post('/chengemember/{id}', [App\Http\Controllers\MembersController::class, 'ChangeMember'])->name('ChangeMember')->middleware('auth');
Route::post('/deletemember/{id}', [App\Http\Controllers\MembersController::class, 'DeleteMember'])->name('DeleteMember')->middleware('auth');
Route::get('/member_project_works/{id}', [App\Http\Controllers\MembersController::class, 'Member_project_Works'])->name('Member_project_Works')->middleware('auth');


