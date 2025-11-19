<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemberShipController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MachineController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Api\SupplementController;
use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ProgramController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');


Route::middleware(['auth:sanctum', 'can:manage memberships'])->group(function(){
    Route::apiResource('memberships', MemberShipController::class);
});


Route::middleware(['auth:sanctum', 'can:manage subscriptions'])->group(function(){
    Route::apiResource('subscriptions', SubscriptionController::class);
}); 


Route::middleware(['auth:sanctum', 'can:manage users'])->group(function(){
    Route::apiResource('members', MemberController::class);
    Route::apiResource('attendances', AttendanceController::class)->only(['index', 'show']);
});


Route::middleware(['auth:sanctum', 'can:self check in'])->group(function(){
    Route::post('attendance/check', [AttendanceController::class, 'checkInOut']);
});


Route::middleware(['auth:sanctum', 'can:manage attendance'])->group(function(){
Route::get('attendances', [AttendanceController::class, 'index']);
    
    Route::get('attendances/{id}', [AttendanceController::class, 'show']);
    
    Route::post('attendances/current', [AttendanceController::class, 'current']);
    
    Route::get('attendances/trainer', [AttendanceController::class, 'trainerAttendances']);
});


Route::middleware(['auth:sanctum', 'can:manage supplements'])->group(function(){
    Route::apiResource('supplements', SupplementController::class);
    Route::post('supplements/purchase', [SupplementController::class,'purchaseSupplement']);
    Route::post('supplements/sale', [SupplementController::class,'saleSupplement']);
});


Route::middleware(['auth:sanctum', 'can:manage payments'])->group(function(){
    Route::apiResource('payments', PaymentController::class);
});


Route::middleware(['auth:sanctum', 'can:manage machines'])->group(function () {
    Route::get('machines', [MachineController::class, 'index']);
    Route::get('machines/{id}', [MachineController::class, 'show']);
    Route::post('machines', [MachineController::class, 'store']);
    Route::post( 'machines/{id}', [MachineController::class, 'update']);
    Route::delete('machines/{id}', [MachineController::class, 'destroy']);
    Route::post('machines/{id}/maintenance', [MachineController::class, 'logMaintenance']);
});


Route::middleware(['auth:sanctum', 'can:manage exercises'])->group(function(){
    Route::post('/exercises/assign-user', [ExerciseController::class, 'createFullProgramForUser']);
    Route::get('exercises/show-user/{id}', [ExerciseController::class, 'showExercisesForUser']);

    Route::apiResource('exercises', ExerciseController::class);
    Route::post('exercises/{id}', [ExerciseController::class, 'update']); 
   
});


Route::middleware(['auth:sanctum', 'can:manage programs'])->group(function () {
    Route::apiResource('programs', ProgramController::class);
    Route::post('programs/assign-user', [ProgramController::class, 'giveProgramToUser']);
});


Route::middleware(['auth:sanctum', 'can:view reports'])->group(function(){
    Route::get('reports/my-subscriptions', [SubscriptionController::class, 'mySubscriptions']);
    Route::get('reports/my-payments', [PaymentController::class, 'myPayments']);
    Route::get('reports/my-attendance', [AttendanceController::class, 'myAttendance']);
    
    // تم توحيد Check-in/out هنا ليتناسب مع صلاحيات الرؤية
    Route::post('reports/kiosk-check-in', [AttendanceController::class, 'kioskCheckIn']);
    Route::post('reports/kiosk-check-out', [AttendanceController::class, 'kioskCheckOut']);
});




Route::middleware(['auth:sanctum', 'can:view my attendance'])->group(function(){

    Route::get('/my-attendance', [AttendanceController::class, 'myAttendance']);});

