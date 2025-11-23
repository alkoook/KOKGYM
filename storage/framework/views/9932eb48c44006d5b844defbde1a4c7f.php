<?php $__env->startSection('content'); ?>
   <div class="w-full max-w-4xl">
    
    <header class="mb-8 border-b border-cyan-800 pb-4">
        <h1 class="font-extrabold text-4xl text-cyan-400 tracking-wider">
            ملفي الشخصي
        </h1>
        <p class="text-gray-400 mt-2 text-lg">إدارة بياناتك الشخصية وحالة اشتراكك.</p>
    </header>

    <!-- بطاقة الملف الشخصي الرئيسية (تم إضافة w-full إليها لتضمن أخذ أقصى عرض مسموح به من الحاوية) -->
    <div class="bg-gray-950/95 backdrop-blur-sm p-6 sm:p-8 rounded-2xl shadow-2xl shadow-cyan-950/70 border border-cyan-800/50 space-y-8 w-full">
        
        <!-- قسم المعلومات الأساسية والصورة -->
        <div class="flex flex-col sm:flex-row items-center sm:items-start border-b border-gray-800 pb-6">
            
            <!-- صورة الملف الشخصي -->
            <div class="mb-4 sm:mb-0 sm:ml-6 relative">
                <img class="w-24 h-24 rounded-full border-4 border-cyan-600 shadow-xl" 
                     src="<?php echo e(asset('/storage/members/'.auth()->user()->photo)); ?>" 
                     alt="صورة الملف الشخصي">
                <!-- زر تعديل الصورة -->
                <button class="absolute bottom-0 left-0 bg-cyan-600 p-2 rounded-full hover:bg-cyan-500 transition duration-200">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </button>
            </div>
            
            <!-- البيانات الأساسية -->
            <div class="flex-1 text-center sm:text-right">
                <h2 class="text-3xl font-extrabold text-white">السيد <?php echo e(auth()->user()->name); ?></h2>
                <p class="text-cyan-400 mt-1">عضو فعال (Premium)</p>
                <p class="text-gray-500 text-sm mt-2">عضو منذ: <?php echo e(\Carbon\Carbon::parse(auth()->user()->created_at)->format('Y-m-d')); ?></p>
            </div>
        </div>

        <!-- قسم حالة الاشتراك -->
        <div class="bg-gray-800/70 p-5 rounded-xl border border-gray-700">
            <h3 class="text-xl font-bold text-cyan-400 mb-3 flex items-center">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                حالة الاشتراك
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                
                <!-- المدة المتبقية (Livewire Component) -->
                <div class="p-3 bg-gray-900 rounded-lg border border-cyan-700/50">
                    <p class="text-xs text-gray-400">الانتهاء بعد</p>
                    <p class="text-2xl font-extrabold text-green-400 mt-1">
                        <!-- مكان تضمين مكون Livewire -->
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('days-remaining', []);

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2435327249-0', null);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                    </p>
                </div>
                
                <!-- نوع الخطة (Blade Component) -->
                <div class="p-3 bg-gray-900 rounded-lg border border-cyan-700/50">
                    <p class="text-xs text-gray-400">الخطة الحالية</p>
                    <p class="text-xl font-extrabold text-white mt-1">
                        <?php
                            $subspcription_id=App\Models\Subscription::where('user_id',auth()->user()->id)->first();
                            $member_ship = App\Models\MemberShip::where('id',$subspcription_id->membership_id)->first();
                        ?>
                        <!-- مكان تضمين متغير Blade -->
                        <?php echo e($member_ship->name); ?>

                    </p>
                </div>

                <!-- تجديد الاشتراك -->
                <div class="p-3 flex items-center justify-center">
                    <button class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded-xl shadow-lg shadow-cyan-600/50 transition duration-300 transform hover:scale-[1.05]">
                        تجديد الاشتراك الآن
                    </button>
                </div>

            </div>
        </div>

        <!-- قسم تعديل البيانات الشخصية -->
        <div class="pt-6 border-t border-gray-800">
            <h3 class="text-xl font-bold text-white mb-4">تعديل البيانات</h3>
            
            <!-- نموذج تعديل (Mockup - يمكنك استخدام Livewire هنا) -->
            <form class="space-y-4">
                
                <!-- حقل الاسم -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-400 mb-1">الاسم الكامل</label>
                    <input type="text" id="name" value="<?php echo e(auth()->user()->name); ?>"
                           class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-cyan-600 focus:border-cyan-600 transition duration-200">
                </div>
                
                <!-- حقل البريد الإلكتروني -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-1">البريد الإلكتروني</label>
                    <input type="email" id="email" value="<?php echo e(auth()->user()->email); ?>"
                           class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-cyan-600 focus:border-cyan-600 transition duration-200" disabled>
                    <p class="text-xs text-gray-500 mt-1">لا يمكن تغيير البريد الإلكتروني من هنا.</p>
                </div>

                <!-- حقل رقم الهاتف -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-400 mb-1">رقم الهاتف</label>
                    <input type="text" id="phone" value="555-1234567"
                           class="w-full p-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-cyan-600 focus:border-cyan-600 transition duration-200">
                </div>

                <!-- زر الحفظ -->
                <div class="pt-4">
                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-extrabold py-3 rounded-xl shadow-lg shadow-green-600/50 transition duration-300 transform hover:scale-[1.01]">
                        حفظ التعديلات
                    </button>
                </div>
            </form>
        </div>
        
        <!-- قسم إحصائيات اللياقة البدنية (للمتابعة) -->
        <div class="pt-6 border-t border-gray-800">
            <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                <svg class="w-5 h-5 ml-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l2 2 4-4m6 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                نظرة عامة على الإحصائيات (آخر قياس)
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-center">
                
                <div class="p-3 bg-gray-800 rounded-lg border border-gray-700">
                    <p class="text-lg font-bold text-white">78.5</p>
                    <p class="text-xs text-gray-400">الوزن (كجم)</p>
                </div>
                
                <div class="p-3 bg-gray-800 rounded-lg border border-gray-700">
                    <p class="text-lg font-bold text-white">18%</p>
                    <p class="text-xs text-gray-400">نسبة الدهون</p>
                </div>
                
                <div class="p-3 bg-gray-800 rounded-lg border border-gray-700">
                    <p class="text-lg font-bold text-white">175</p>
                    <p class="text-xs text-gray-400">القامة (سم)</p>
                </div>
                
                <div class="p-3 bg-gray-800 rounded-lg border border-gray-700">
                    <p class="text-lg font-bold text-white">72 كجم</p>
                    <p class="text-xs text-gray-400">الوزن الصافي</p>
                </div>

            </div>
        </div>

    </div>
    
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/user/user_profile.blade.php ENDPATH**/ ?>