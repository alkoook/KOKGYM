<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class UserController extends Controller
{
    public function home(){
       return view('user.home') ;
    }
    public function profile(){
       return view('user.user_profile') ;
    }
        public function program(){
       return view('user.program') ;
    }
    public function me_program(){
        return view('user.me_program');
    }
      public function payment(){
        return view('user.payment');
    }
    
       public function progress(){
        return view('user.progress');
    }
       public function subscriptions(){
        return view('user.subscriptions');
    }
       public function supplements(){
        return view('user.supplements');
    }
       public function machines(){
        return view('user.machines');
    }
       public function workouts(){
        return view('user.workouts');
    }
   public function logout(Request $request): RedirectResponse
    {
        // 1. استخدام الدالة المساعدة لـ Auth لتسجيل الخروج من جميع الحراس (Guards)
        Auth::guard('web')->logout();

        // 2. إلغاء صلاحية الجلسة الحالية
        $request->session()->invalidate();

        // 3. إعادة توليد رمز CSRF جديد لمنع هجمات الاستغلال
        $request->session()->regenerateToken();

        // 4. إعادة التوجيه إلى الصفحة الرئيسية أو صفحة تسجيل الدخول
        return redirect('/');
    }
}
