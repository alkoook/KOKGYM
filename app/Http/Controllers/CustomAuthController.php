<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use App\Models\User; // يجب استيراد نموذج المستخدم

class CustomAuthController extends Controller
{
    // ===================================================
    // 1. عرض صفحات تسجيل الدخول
    // ===================================================

    /**
     * عرض صفحة تسجيل دخول الأعضاء (Member Login).
     */
    public function showLogin()
    {
        // يتم استخدام هذا العرض عادةً لتسجيل دخول الأعضاء (members)
        return view('login');
    }

    /**
     * عرض صفحة تسجيل دخول الإداريين/المدربين (Admin/Trainer Login)
     */
    public function showAdminLogin()
    {
        // عرض منفصل لمنطقة الإدارة
        return view('admin.login'); 
    }
    
    // ===================================================
    // 2. معالجة تسجيل الدخول (Login)
    // ===================================================

    /**
     * معالجة طلب تسجيل الدخول والتحقق من الدور باستخدام Spatie.
     */
 public function login(Request $request)
{
    // تحقق من الإدخالات الأساسية
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
        'uid' => ['required', 'numeric'],
    ]);

    // جلب المستخدم بناءً على البريد والـ UID
    $user = User::where('email', $request->email)
                            ->where('uid', $request->uid)
                            ->first();

    if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => 'الإيميل أو كلمة السر أو UID خاطئ.',
        ]);
    }

    // تحقق من الدور
    if (! $user->hasRole('member')) {
        throw ValidationException::withMessages([
            'email' => 'لا يمكنك الدخول بهذا الايميل. يرجى استخدام صفحة الدخول الصحيحة لدورك الفعلي.',
        ]);
    }

    // تسجيل الدخول
    Auth::login($user);

    // تجديد الجلسة
    $request->session()->regenerate();

    return redirect()->intended(route('dashboard'));
}


    // ===================================================
    // 3. معالجة تسجيل الخروج (Logout)
    // ===================================================

    /**
     * معالجة طلب تسجيل الخروج.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}