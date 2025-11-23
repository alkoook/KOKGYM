<?php $__env->startSection('content'); ?>

    
    <?php
        use Carbon\Carbon;
        use App\Models\Post; // استيراد نموذج المنشورات
        use App\Models\Subscription;
        use App\Models\MemberShip;

        // ---------------------------------------------
        // 1. حساب BMI
        // ---------------------------------------------
        // افتراض: وزن المستخدم (كجم) وطوله (سم) موجودان في نموذج المستخدم
        $user = auth()->user();
        $weight = $user->weight;
        $heightCm = $user->height;
        $heightM = $heightCm > 0 ? $heightCm / 100 : 0;
        $bmi = 0;
        if ($weight > 0 && $heightM > 0) {
            $bmi = round($weight / ($heightM * $heightM), 1);
        }

        // دالة تحديد حالة BMI
        $bmiStatus = 'غير محدد';
        $bmiColor = 'text-gray-400';
        if ($bmi > 0) {
            if ($bmi < 18.5) {
                $bmiStatus = 'نقص الوزن';
                $bmiColor = 'text-yellow-500';
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $bmiStatus = 'وزن صحي';
                $bmiColor = 'text-green-500';
            } elseif ($bmi >= 25.0 && $bmi <= 29.9) {
                $bmiStatus = 'زيادة وزن';
                $bmiColor = 'text-orange-500';
            } else {
                $bmiStatus = 'سمنة';
                $bmiColor = 'text-red-500';
            }
        }

        // ---------------------------------------------
        // 2. حساب أيام الاشتراك وجلب الخطة
        // ---------------------------------------------
        $sub = Subscription::where('user_id', auth()->id())->first();

        $daysLeft = $sub && $sub->end_date
            ? intval(Carbon::now()->diffInRealDays(Carbon::parse($sub->end_date), false))
            : null;

        $member_ship = $sub ? MemberShip::where('id', $sub->membership_id)->first() : null;
        $membershipName = $member_ship ? $member_ship->name : 'غير مشترك';

        // ---------------------------------------------
        // 3. جلب آخر 10 منشورات (الأخبار أو النصائح)
        // ---------------------------------------------
        $latestPosts = Post::latest()->take(10)->get();

        // ---------------------------------------------
        // 4. منطق هدف الوزن المثالي وتقدير المدة (التعديل المطلوب)
        // ---------------------------------------------

        // نختار هدف BMI في منتصف النطاق الصحي (مثلاً 21.7)
        $targetBMI = 25;

        // حساب الوزن المثالي المستهدف بناءً على الطول
        $targetWeight = round($targetBMI * ($heightM * $heightM), 1);

        // الفرق في الوزن للوصول للهدف
        $weightDifference = $weight - $targetWeight;

        // معدل الخسارة الأسبوعي المفترض (0.5 كجم كحد أدنى صحي)
        $weeklyLossRate = 1; // كجم/أسبوع

        $weeksToTarget = 0;
        $progressPercentage = 0; // سيمثل نسبة التقدم نحو الهدف

        if ($weightDifference > 0) {
            // حالة زيادة الوزن: نحتاج لخسارة وزن
            $weeksToTarget = ceil($weightDifference / $weeklyLossRate);

            // لحساب نسبة التقدم نحو الهدف (نفترض هدفاً ثابتاً مثلاً 20 كجم خسارة كحد أقصى للتمثيل)
            // نستخدم هنا نسبة بسيطة افتراضية للتمثيل البصري
            $maxLossForDisplay = 20; // 20 كجم كأقصى مدى تقريبي لعرض التقدم
            $progressPercentage = min(100, round(($weightDifference / $maxLossForDisplay) * 100)); // نسبة افتراضية
            $progressDirection = "نحو الخسارة";
        } elseif ($weightDifference < 0) {
            // حالة نقص الوزن: نحتاج لزيادة وزن
            $weeksToTarget = ceil(abs($weightDifference) / $weeklyLossRate); // نستخدم نفس المعدل كتقدير
            $progressPercentage = 100; // نعتبره 100% أو يمكننا تصميم منطق تقدم للزيادة
            $progressDirection = "نحو الزيادة";
        } else {
             // الوزن مثالي
             $weeksToTarget = 0;
             $progressPercentage = 100;
             $progressDirection = "الوزن مثالي";
        }

        // تحويل الأسابيع إلى أشهر وأيام لتكون النتيجة سهلة القراءة
        $monthsToTarget = floor($weeksToTarget / 4);
        $remainingWeeks = $weeksToTarget % 4;

        if ($weeksToTarget > 0) {
            $expectedDuration = '';
            if ($monthsToTarget > 0) {
                $expectedDuration .= $monthsToTarget . ' شهر ';
            }
            if ($remainingWeeks > 0) {
                $expectedDuration .= 'و' . $remainingWeeks . ' أسابيع';
            }
        } else {
            $expectedDuration = 'الهدف محقق! (ثبات)';
        }


    ?>

    <div class="space-y-8">
        <!-- قسم البطاقات الإحصائية الشخصية (Stat Cards) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- البطاقة 1: الوزن الحالي -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-cyan-600 transition duration-300 hover:shadow-cyan-500/30">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-cyan-400">الوزن الحالي</p>
                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354l-4.243 4.243a1 1 0 00-.293.707v5.657a1 1 0 00.293.707l4.243 4.243a1 1 0 001.414 0l4.243-4.243a1 1 0 00.293-.707V9.304a1 1 0 00-.293-.707L13.414 4.354a1 1 0 00-1.414 0z"></path></svg>
                </div>
                <p class="text-3xl font-extrabold text-white mt-2"><?php echo e($weight); ?></p>
                <p class="text-sm text-gray-400 mt-1">كيلوجرام</p>

                <div class="flex items-center justify-between">
                    <p class="text-l font-semibold text-red-400"> الطول </p>
                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354l-4.243 4.243a1 1 0 00-.293.707v5.657a1 1 0 00.293.707l4.243 4.243a1 1 0 001.414 0l4.243-4.243a1 1 0 00.293-.707V9.304a1 1 0 00-.293-.707L13.414 4.354a1 1 0 00-1.414 0z"></path></svg>
                </div>
                <p class="text-3xl font-extrabold text-white mt-2"><?php echo e($heightCm); ?></p>
                <p class="text-sm text-gray-400 mt-1">سم</p>
            </div>

            <!-- البطاقة 2: مقياس BMI -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-lime-600 transition duration-300 hover:shadow-lime-500/30">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-lime-400">مؤشر كتلة الجسم</p>
                    <svg class="w-6 h-6 text-lime-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10V5a2 2 0 00-2-2m0 0H7a2 2 0 00-2 2v5h9l4 4v7h-5m-9-6h9"></path></svg>
                </div>
                <p class="text-3xl font-extrabold text-white mt-2">
                    <?php echo e($bmi > 0 ? $bmi : 'N/A'); ?>

                </p>
                
                <p class="text-sm font-bold <?php echo e($bmiColor); ?> mt-1"><?php echo e($bmiStatus); ?></p>
                <p class="text-xs text-gray-400">الطول: <?php echo e($heightCm); ?> سم</p>
            </div>

            <!-- البطاقة 3: أيام التدريب المتبقية -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-indigo-600 transition duration-300 hover:shadow-indigo-500/30">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-indigo-400">الاشتراك ينتهي بعد</p>
                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-3xl font-extrabold text-white mt-2">
                    <?php echo e($daysLeft ?? 'N/A'); ?>

                </p>
                <p class="text-sm font-bold text-gray-300 mt-1">يوم متبقي</p>
                <p class="text-xs text-gray-400"> الخطة: <span class="font-semibold text-indigo-300"><?php echo e($membershipName); ?></span></p>
            </div>

            <!-- البطاقة 4: هدف الوزن المثالي وتقدير المدة (التعديل الجديد) -->
            <div class="bg-gray-800 p-6 rounded-xl shadow-lg border-b-4 border-pink-600 transition duration-300 hover:shadow-pink-500/30">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-pink-400">هدف الوزن المثالي (BMI)</p>
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V5a2 2 0 00-2-2H4a2 2 0 00-2 2v7l4 4 4 4 4-4 4-4v-7h-5z"></path></svg>
                </div>
                <p class="text-xl font-extrabold text-white mt-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($weightDifference > 0): ?>
                        خسارة <?php echo e($weightDifference); ?> كجم
                    <?php elseif($weightDifference < 0): ?>
                        زيادة <?php echo e(abs($weightDifference)); ?> كجم
                    <?php else: ?>
                        الوزن المثالي محقق!
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </p>
                <p class="text-sm font-bold text-gray-300 mt-1">
                    الوزن المستهدف: <span class="text-green-300"><?php echo e($targetWeight); ?> كجم</span>
                </p>

                
                <div class="mt-2">
                    <p class="text-xs text-pink-300 font-semibold">المدة المتوقعة للوصول للهدف:</p>
                    <p class="text-base font-extrabold text-white"><?php echo e($expectedDuration); ?></p>
                    <p class="text-xs text-gray-400">بمعدل <?php echo e($weeklyLossRate); ?> كجم/أسبوع</p>
                </div>

            </div>
        </div>

        <!-- لوحة الأخبار والنصائح (Posts Card) - باقية كما هي -->
        <div class="bg-gray-800 p-6 rounded-xl shadow-2xl shadow-gray-950/50 border border-gray-700">
            <h2 class="text-xl font-bold text-white mb-6 flex items-center border-b border-gray-700 pb-3">
                <svg class="w-6 h-6 ml-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v10m-2 2h4m-4 0h4m-8 4v-4m0 0h4m-4 0h4m-12 0h4m-4 0h4"></path></svg>
                آخر 10 نصائح وأخبار رياضية
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $latestPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-gray-900 p-4 rounded-lg border-r-4 border-yellow-500 transition duration-200 hover:bg-gray-700/50 flex flex-col">
                        <h3 class="text-lg font-bold text-yellow-400 mb-2"><?php echo e($post->title); ?></h3>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->image): ?>
                            <div class="mb-3">
                                
                                <img src="<?php echo e(asset('storage/posts/' . $post->image)); ?>" alt="صورة للمنشور: <?php echo e($post->title); ?>" class="w-full h-40 object-cover rounded-md shadow-md">
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <p class="text-sm text-gray-300 line-clamp-3 mb-3 flex-grow"><?php echo e(Str::limit($post->body, 150)); ?></p>

                        <div class="mt-auto text-left">
                            
                            <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="text-xs font-semibold text-cyan-400 hover:text-cyan-300 transition duration-150">
                                قراءة المزيد &larr;
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <div class="md:col-span-2 text-center text-gray-500 p-8 border border-gray-700 rounded-xl">
                        <p class="text-lg">لا توجد منشورات أو نصائح لعرضها حالياً. يرجى إضافة محتوى جديد!</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/user/home.blade.php ENDPATH**/ ?>