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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/registproject', [App\Http\Controllers\ProjectsController::class, 'RegistProject'])->name('RegistProject');
Route::get('/preparationproject', [App\Http\Controllers\ProjectsController::class, 'PreparationProject'])->name('PreparationProject');
Route::get('/executionproject', [App\Http\Controllers\ProjectsController::class, 'ExecutionProject'])->name('ExecutionProject');
Route::get('/completionproject', [App\Http\Controllers\ProjectsController::class, 'CompletionProject'])->name('CompletionProject');
Route::get('/editproject/{id}', [App\Http\Controllers\ProjectsController::class, 'EditProject'])->name('EditProject');
Route::post('/changeproject/{id}', [App\Http\Controllers\ProjectsController::class, 'ChangeProject'])->name('ChangeProject');
Route::get('/selectprolect/{id}', [App\Http\Controllers\WorksController::class, 'SelectProject'])->name('SelectProject');
Route::post('/deleteproject/{id}', [App\Http\Controllers\ProjectsController::class, 'DeleteProject'])->name('DeleteProject');

Route::post('/registplan', [App\Http\Controllers\WorksController::class, 'RegistPlan'])->name('RegistPlan');
Route::get('/startplan/{id}', [App\Http\Controllers\WorksController::class, 'StartPlan'])->name('StartPlan');
Route::get('/endplan/{id}', [App\Http\Controllers\WorksController::class, 'EndPlan'])->name('EndPlan');
Route::get('/endplan/{id}', [App\Http\Controllers\WorksController::class, 'EndPlan'])->name('EndPlan');
Route::get('/editplan/{id}', [App\Http\Controllers\WorksController::class, 'EditPlan'])->name('EditPlan');
Route::post('/changeplan/{id}', [App\Http\Controllers\WorksController::class, 'ChangePlan'])->name('ChangePlan');
Route::post('/deleteplan/{id}', [App\Http\Controllers\WorksController::class, 'DeletePlan'])->name('DeletePlan');

Route::get('/memberlist', [App\Http\Controllers\MembersController::class, 'MemberList'])->name('MemberList');
Route::post('/registmember', [App\Http\Controllers\MembersController::class, 'RegistMember'])->name('RegistMember');
Route::get('/editmember/{id}', [App\Http\Controllers\MembersController::class, 'EditMember'])->name('EditMember');
Route::post('/chengemember/{id}', [App\Http\Controllers\MembersController::class, 'ChangeMember'])->name('ChangeMember');
Route::post('/deletemember/{id}', [App\Http\Controllers\MembersController::class, 'DeleteMember'])->name('DeleteMember');
Route::get('/member_project_plan/{id}', [App\Http\Controllers\MembersController::class, 'Member_project_Plan'])->name('Member_project_Plan');


