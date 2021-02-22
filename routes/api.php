<?php

use App\Http\Controllers\Mobileapp\MobileLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Mobileapp\RegUsersController;
use App\Http\Controllers\Mobileapp\ResultOverviewController;
use App\Http\Controllers\Mobileapp\StudentExamController;
use App\Http\Controllers\Mobileapp\StduentDetailsController;
use App\Http\Controllers\Mobileapp\SubjectController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("login",[MobileLogin::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::post("logout",[MobileLogin::class, 'logout']);
    Route::get("reguserCount/{year?}/{month?}",[RegUsersController::class,'countRegUser']);
    Route::get("active",[RegUsersController::class,'activeStudents']);
    Route::get('examSchedule',[StudentExamController::class,'examSchedule']);
    Route::get('currentExam',[StudentExamController::class,'currentExam']);
    Route::get('studentDetails/{id}',[StduentDetailsController::class,'studentDetails']);
    Route::get('searchStudents',[StduentDetailsController::class,'searchStudents']);
    Route::get('searchStudentsbyname/{name?}',[StduentDetailsController::class,'searchStudentsbyname']);
    Route::get('searchStudentsbyRegNo/{regNo?}',[StduentDetailsController::class,'searchStudentsbyRegNo']);
    Route::get('subjectDetails',[SubjectController::class,'subjectDetails']);
    Route::get('subjectresult/{id}/{year?}/{month?}',[SubjectController::class,'subjectresult']);
    Route::get('fetchscheduleIds/{id}/{year?}/{month?}',[SubjectController::class,'fetchscheduleIds']);
    Route::get('resultoverview/{year?}',[ResultOverviewController::class,'resultoverview']);


});
