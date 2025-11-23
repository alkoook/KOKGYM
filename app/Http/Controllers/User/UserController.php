<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Supplement;
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
        $supplements=Supplement::all();
        return view('user.supplements',['supplements'=>$supplements]);
    }
       public function machines(){
        return view('user.machines');
    }
    public function workoutsShow(Exercise $workout)
    {
     // تحميل العلاقات المفقودة أو الأساسية لصفحة التفاصيل
        $exercises= Exercise::with(['machine','creator'])->get();

        // تمرير التمرين إلى ملف Blade
        return view('user.workouts', [
            'exercises' => $exercises,
        ]);
    }

        public function workoutsIndex()
    {
        // 1. جلب المستخدم الحالي
        $user = Auth::user();
        try {
            $workouts = $user->exercises()
                             ->get();

            // تمرير البيانات إلى ملف Blade
            return view('user.workouts', [
                'workouts' => $workouts,
            ]);

        } catch (\Exception $e) {
            \Log::error("Failed to retrieve user workouts for ID: {$user->id}. Error: " . $e->getMessage());
            // يمكنك توجيه المستخدم لصفحة خطأ أو رسالة بسيطة
            return view('error', ['message' => 'حدث خطأ أثناء جلب التمارين.']);
        }
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
