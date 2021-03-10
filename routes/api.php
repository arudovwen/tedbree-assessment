<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// Guest 
Route::get('jobs', [App\Http\Controllers\JobController::class, 'showJobs']);

Route::get('jobs/{job_id}', [App\Http\Controllers\JobController::class, 'showJob']);

Route::post('jobs/{job_id}/apply', [App\Http\Controllers\JobController::class, 'applyJob']);


// Admin 
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('user', [App\Http\Controllers\RegisteredUserController::class, 'show']);
  
    Route::get('my/jobs', [App\Http\Controllers\JobController::class, 'allJobs']);

    Route::post('my/jobs', [App\Http\Controllers\JobController::class, 'storeJob']);

    Route::get('my/jobs/{job_id}/applications', [App\Http\Controllers\JobController::class, 'allApplications']);

    Route::patch('my/jobs/{job_id}', [App\Http\Controllers\JobController::class, 'updateJob']);

    Route::delete('my/jobs/{job_id}', [App\Http\Controllers\JobController::class, 'destroyJob']);

    Route::post('logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy']);
});


Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);


