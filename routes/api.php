<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\Api\TrainingController;
use App\Http\Controllers\Api\EnterpriseController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\HobbieController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Auth\RegisterationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;





// route api documentation (swagger)

// enterprises routes
Route::get('enterprises', [EnterpriseController::class, 'index']);
Route::post('enterprises', [EnterpriseController::class, 'store']);
Route::get('enterprises/{id}', [EnterpriseController::class, 'show']);
Route::put('enterprises/{id}', [EnterpriseController::class, 'update']);
Route::patch('enterprises/{id}', [EnterpriseController::class, 'update']);
Route::delete('enterprises/{id}', [EnterpriseController::class, 'delete']);

// hobbie routes
Route::get('hobbies', [HobbieController::class, 'index']);
Route::post('hobbies', [HobbieController::class, 'store']);
Route::get('hobbies/{id}', [HobbieController::class, 'show']);
Route::put('hobbies/{id}', [HobbieController::class, 'update']);
Route::patch('hobbies/{id}', [HobbieController::class, 'update']);
Route::delete('hobbies/{id}', [HobbieController::class, 'delete']);

// jobs routes
Route::get('jobs', [JobController::class, 'index']);
Route::post('job', [JobController::class, 'store']);
Route::get('jobs/{id}', [JobController::class, 'show']);
Route::put('jobs/{id}', [JobController::class, 'update']);
Route::patch('jobs/{id}', [JobController::class, 'update']);
Route::delete('jobs/{id}', [JobController::class, 'delete']);

// profiles routes
Route::get('profiles', [ProfileController::class, 'index']);
Route::post('profiles', [ProfileController::class, 'store']);
Route::get('profiles/{id}', [ProfileController::class, 'show']);
Route::put('profiles/{id}', [ProfileController::class, 'update']);
Route::patch('profiles/{id}', [ProfileController::class, 'update']);
Route::delete('profiles/{id}', [ProfileController::class, 'delete']);

// skills routes
Route::get('skills', [SkillController::class, 'index']);
Route::post('skills', [SkillController::class, 'store']);
Route::get('skills/{id}', [SkillController::class, 'show']);
Route::put('skills/{id}', [SkillController::class, 'update']);
Route::patch('skills/{id}', [SkillController::class, 'update']);
Route::delete('skills/{id}', [SkillController::class, 'delete']);

// trainings routes
Route::apiResource('trainings', TrainingController::class);
// Route::get('trainings', [TrainingController::class, 'index']);
// Route::post('trainings', [TrainingController::class, 'store']);
// Route::get('trainings/{id}', [TrainingController::class, 'show']);
// Route::put('trainings/{id}', [TrainingController::class, 'update']);
// Route::patch('trainings/{id}', [TrainingController::class, 'update']);
// Route::delete('trainings/{id}', [TrainingController::class, 'delete']);

// Ratings
Route::get('ratings', [ProfileController::class, 'ratings']);


// route for sessions
Route::get('sessions', [TrainingController::class, 'sessions']);

// Profile Hobbile routes
Route::get('profilehobbies', [HobbieController::class, 'ProfileHobbie']);

// Profile skills routes
Route::get('profileskills', [SkillController::class, 'profileskill']);

// Job skill routes
Route::get('jobskills', [JobController::class, 'skilljob']);


//route for passport


     
Route::middleware(['json.response', 'auth:api'])->group( function () {
    Route::resource('profiles', ProfileController::class);
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
// route for spatie role and permissions

  

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class); 

