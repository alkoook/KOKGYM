<?php
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Can;

// ===================================================
// 1. مسارات الدخول (للزوار فقط)
// ===================================================

Route::middleware('guest')->group(function () {
    // صفحة تسجيل دخول الأعضاء (الافتراضية)
    Route::get('/', [CustomAuthController::class, 'showLogin'])->name('login');

    // صفحة تسجيل دخول الإداريين / المدربين (المسار المشار إليه في صفحة الأعضاء)
    Route::get('/admin-login', [CustomAuthController::class, 'showAdminLogin'])->name('admin.login');

    // مسار معالجة تسجيل الدخول الموحد
    // ملاحظة: يجب أن يقوم التابع CustomAuthController::login() بالتحقق من دور المستخدم
    // وإعادة التوجيه إلى '/dashboard' للأعضاء أو إلى '/admin/dashboard' للإداريين والمدربين.
    Route::post('/login', [CustomAuthController::class, 'login'])->name('login.post');
});

// ===================================================
// 2. مسارات المستخدمين الموثقين (بحسب الدور)
// ===================================================



Route::prefix('user')->middleware(['auth','can:view supplements'])->group(function(){
    Route::get('/home',[UserController::class,'home'])->name('user.home');
    Route::get('/profile',[UserController::class, 'profile'])->name('user.profile');
    Route::get('/program',[UserController::class, 'program'])->name('user.program');
    Route::get('/me-program',[UserController::class, 'me_program'])->name('user.me.program');
    Route::get('/payment',[UserController::class, 'payment'])->name('user.payment');
    Route::get('/progress',[UserController::class, 'progress'])->name('user.progress');




// مسارات إدارة وعرض المكملات الغذائية (Supplements)
Route::get('/supplements', [UserController::class, 'supplements'])
    ->name('user.supplements'); // المسار الذي يعرض قائمة المكملات


    Route::get('/subscriptions',[UserController::class, 'subscriptions'])->name('user.subscriptions');
    Route::get('/machines',[UserController::class, 'machines'])->name('user.machines');

    Route::get('/workouts',[UserController::class, 'workoutsShow'])->name('user.workouts');




    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

    Route::get('/dashboard', function() {
        // يمكنك إضافة ميدل وير (middleware) للتحقق من أن الدور هو 'member'
        return view('user.home'); // يعرض صفحة لوحة تحكم الأعضاء
    })->name('dashboard');
});
