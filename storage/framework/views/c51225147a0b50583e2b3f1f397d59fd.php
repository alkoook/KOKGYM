
<?php $__env->startSection('content'); ?>
 

            <div class="space-y-6">
                <!-- قسم البطاقات الشخصية (Personal Stat Cards) -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    
                    <!-- البطاقة 1: الحصة القادمة -->
                    <div class="bg-gray-800 p-4 rounded-xl shadow-lg border-t-4 border-cyan-600">
                        <p class="text-xs text-cyan-400 font-semibold">الحصة القادمة</p>
                        <p class="text-lg font-bold text-white mt-1">كارديو HIIT</p>
                        <p class="text-xs text-gray-400">اليوم 6:00 مساءً</p>
                    </div>

                    <!-- البطاقة 2: الوزن الحالي -->
                    <div class="bg-gray-800 p-4 rounded-xl shadow-lg border-t-4 border-cyan-600">
                        <p class="text-xs text-cyan-400 font-semibold"> مقياس الـ BMI</p>
                        <p class="text-lg font-bold text-white mt-1"></p>
                        <p class="text-xs text-gray-400">الهدف: 75 كجم</p>
                    </div>

                    <!-- البطاقة 3: أيام التدريب المتبقية (Livewire) -->
                    <div class="bg-gray-800 p-4 rounded-xl shadow-lg border-t-4 border-cyan-600">
                        <p class="text-xs text-cyan-400 font-semibold">الاشتراك ينتهي بعد</p>
                        <p class="text-lg font-bold text-white mt-1">
                            <?php
                        use Carbon\Carbon;

                        $sub = App\Models\Subscription::where('user_id', auth()->id())->first();

                        $daysLeft = $sub && $sub->end_date
                            ? intval(Carbon::now()->diffInRealDays(Carbon::parse($sub->end_date), false))
                            : null;
                    ?>

                    <?php echo e($daysLeft); ?> يوم
                        </p>

                        <p class="text-xs text-gray-400"><?php
                            $subspcription_id=App\Models\Subscription::where('user_id',auth()->user()->id)->first();
                            $member_ship = App\Models\MemberShip::where('id',$subspcription_id->membership_id)->first();
                        ?>
                            <!-- تم إرجاع Blade هنا -->
                            الخطة الـ  <?php echo e($member_ship->name); ?>

                        </p>
                    </div>

                    <!-- البطاقة 4: آخر تمرين -->
                    <div class="bg-gray-800 p-4 rounded-xl shadow-lg border-t-4 border-cyan-600">
                        <p class="text-xs text-cyan-400 font-semibold">آخر تمرين</p>
                        <p class="text-lg font-bold text-white mt-1">تمرين الظهر</p>
                        <p class="text-xs text-gray-400">منذ 15 ساعة</p>
                    </div>
                </div>
                
                <!-- لوحة التقدم الرئيسية (Progress Card) -->
                <div class="bg-gray-800 p-6 rounded-xl shadow-2xl shadow-gray-950/50 border border-gray-700">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l2-2 2 2v13M9 19h6M12 4v16"></path></svg>
                        البرنامج التدريبي الحالي: بناء العضلات (المرحلة 2)
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- تمرين اليوم -->
                        <div class="border-b border-gray-700 pb-3">
                            <h3 class="text-lg font-semibold text-cyan-400">تمرين اليوم: الأرجل والأكتاف</h3>
                            <ul class="list-disc pr-5 mt-2 text-gray-300 space-y-1">
                                <li>القرفصاء (Squat) - 4 مجموعات × 10 تكرارات</li>
                                <li>الرفعة المميتة الرومانية (RDL) - 3 مجموعات × 12 تكرار</li>
                                <li>ضغط الأكتاف بالدمبل (Dumbbell Press) - 4 مجموعات × 8 تكرارات</li>
                            </ul>
                            <button class="mt-3 text-sm font-medium bg-cyan-600 hover:bg-cyan-700 text-white py-1 px-3 rounded-lg transition duration-200">
                                تم الانتهاء من التمرين
                            </button>
                        </div>
                        
                        <!-- الإنجازات -->
                        <div>
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 15l-5.878 3.09 1.123-6.545L.487 7.71a1 1 0 01.554-.515l6.574-.955L10 .474l2.385 5.766 6.574.955a1 1 0 01.554.515l-4.26 4.14 1.123 6.545L10 15z"></path></svg>
                                إنجازاتك
                            </h3>
                            <p class="text-gray-400 mt-1">لقد تدربت 5 أيام متتالية! استمر هكذا يا بطل.</p>
                        </div>
                    </div>
                </div>
            </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\projects\kokGym\resources\views/user/home.blade.php ENDPATH**/ ?>