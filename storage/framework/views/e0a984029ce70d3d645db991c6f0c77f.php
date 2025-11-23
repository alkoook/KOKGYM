<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOK GYM - لوحة القيادة الشخصية</title>
 
    <style>
        /* تعريف خط Cairo ودعم لغة عربية أفضل */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');
        body {
            font-family: 'Cairo', 'Inter', sans-serif;
        }
        /* إخفاء شريط التمرير */
        .sidebar-scroll { scrollbar-width: none; }
        .sidebar-scroll::-webkit-scrollbar { display: none; }
    </style>
<style>
    /* الخطوط والأبعاد الأساسية */
    body {
        font-family: 'Inter', sans-serif;
    }

    /* تعريف النمط الجديد للزر الأزرق الداكن الأنيق */
    .premium-button-v3 {
        /* لون أساسي نيلي داكن */
        background: #4f46e5; /* Indigo-600 */
        
        /* تدرج خفيف لإضافة عمق */
        background-image: linear-gradient(145deg, #6366f1 0%, #4f46e5 100%); /* Indigo-500 to Indigo-600 */
        
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        
        /* ظل خارجي متوهج وناعم بلون النيلي */
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5), /* توهج نيلي ناعم */
                    0 0 5px rgba(255, 255, 255, 0.1) inset; /* إضاءة داخلية خفيفة */
    }
    
    .premium-button-v3:hover {
        /* يكبر قليلاً عند المرور ويصبح التدرج أوضح */
        background-image: linear-gradient(145deg, #4338ca 0%, #3730a3 100%); /* Blue-700/800 */
        transform: translateY(-1px) scale(1.01);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.7);
    }
    
    .premium-button-v3:active {
        /* تأثير الضغط للداخل */
        transform: translateY(1px) scale(0.99);
        box-shadow: 0 3px 10px rgba(99, 102, 241, 0.4), 
                    inset 0 1px 4px rgba(0, 0, 0, 0.6); /* ظل داخلي للضغط */
    }
</style>


    <!-- إعدادات Tailwind للثيم الداكن والـ Cyan -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        cyan: {
                            400: '#22d3ee',
                            600: '#0891b2',
                            700: '#0e7490', /* تم إضافة درجة 700 لليستة */
                            800: '#155e75',
                            950: '#083344',
                        },
                    }
                }
            }
        }
    </script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


</head>

<body class="dark bg-gray-900 text-gray-100">

    <!--
        الحاوية الرئيسية: نتحكم هنا بحالة الشريط الجانبي (isSidebarOpen)
    -->
    <div x-data="{ isSidebarOpen: true }" class="flex relative min-h-screen">
        
        <!--
            1. الشريط الجانبي (Sidebar) - تم إصلاح مشكلة إخفاء النصوص هنا
        -->
        <aside 
            :class="isSidebarOpen ? 'w-64' : 'w-20'" 
            class="sidebar-scroll bg-gray-950/95 backdrop-blur-sm min-h-screen shadow-2xl shadow-cyan-950/70
                   p-4 relative transition-all duration-300 ease-in-out flex flex-col justify-between fixed top-0 right-0 z-50 border-l border-cyan-800/30">
            
            <div>
                <!-- زر الفتح والإغلاق (Toggle Button) -->
                <button 
                    @click="isSidebarOpen = !isSidebarOpen"
                    :class="isSidebarOpen ? 'rotate-0' : 'rotate-180'"
                    class="absolute top-4 -right-3 p-2 bg-cyan-600 hover:bg-cyan-500 text-white rounded-full 
                            shadow-xl transition-all duration-300 transform ring-4 ring-gray-950 z-20 focus:outline-none focus:ring-cyan-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                    </svg>
                </button>
        
                <!-- الشعار/الملف الشخصي -->
                <div class="pt-2 pb-4 border-b border-gray-800 mb-4 flex flex-col items-center">
                    
                    <!-- الشعار الكامل (يظهر عند الفتح) -->
                    <div x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms
                         class="text-2xl font-extrabold text-cyan-400 mb-3 transition-opacity duration-300">
                        👑 KOK GYM
                    </div>
                    <!-- الشعار المصغر (يظهر عند الإغلاق) -->
                    <div x-show="!isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms
                         class="text-4xl font-extrabold text-cyan-400">
                        K
                    </div>
                    
                    <!-- الملف الشخصي للمستخدم -->
                    <div x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mt-4">
                        <img class="w-28 h-18 rounded-full border-2 border-cyan-500 shadow-lg mx-auto" 
                             src="<?php echo e(asset('/storage/members/'.auth()->user()->photo)); ?>" 
                             alt="ملف المستخدم">
                        <div class="text-center mt-2">
                            <span class="font-bold text-white block"> السيد <?php echo e(auth()->user()->name); ?></span></span>
                            <span class="text-xs text-green-400"><?php $sub=App\Models\Subscription::where('user_id',auth()->user()->id)->exists(); ?>
                                
                            <?php echo e($sub? '(Primum) عضو فعال ' : 'عضو غير فعال'); ?> </span>
                        </div>
                    </div>
                </div>
                
                <!-- قائمة التنقل الخاصة بالعضو -->
<nav class="space-y-2">

    <!-- الرابط 1: الرئيسية -->
    <a href="<?php echo e(route('user.home')); ?>" 
       class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500
       <?php echo e(request()->routeIs('user.home') ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'); ?>">
        <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('user.home') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">الرئيسية (لوحتي)</span>
    </a>

    <!-- الرابط 2: ملفي الشخصي -->
    <a href="<?php echo e(route('user.profile')); ?>" 
       class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500
       <?php echo e(request()->routeIs('user.profile') ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'); ?>">
        <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('user.profile') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">ملفي الشخصي</span>
    </a>

    <!--البرامج  -->
    <a href="<?php echo e(route('user.program')); ?>" 
       class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500
       <?php echo e(request()->routeIs('training.program') ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'); ?>">
        <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('training.program') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l2-2 2 2v13M9 19h6M12 4v16"></path>
        </svg>
        <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10"> البرامج </span>
    </a>
<!-- ============================================= -->
<!-- الرابط 1: المكملات (Supplements) -->
<!-- ============================================= -->
<a href="<?php echo e(route('user.supplements')); ?>" 
    class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-green-500
    <?php echo e(request()->routeIs('user.supplements') ? 'bg-green-700 text-white shadow-lg shadow-green-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-green-400'); ?>">
    <!-- أيقونة كبسولة/حبة دواء -->
    <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('user.supplements') ? 'text-white' : 'text-gray-500 group-hover:text-green-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">المكملات الغذائية</span>
</a>


<!-- ============================================= -->
<!-- الرابط 2: التمارين (Workouts) -->
<!-- ============================================= -->
<a href="<?php echo e(route('user.workouts')); ?>" 
    class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-fuchsia-500
    <?php echo e(request()->routeIs('user.workouts') ? 'bg-fuchsia-700 text-white shadow-lg shadow-fuchsia-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-fuchsia-400'); ?>">
    <!-- أيقونة العضلة (Dumbbell/Biceps) -->
    <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('user.workouts') ? 'text-white' : 'text-gray-500 group-hover:text-fuchsia-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11l-3 3-3-3m6-4l-3 3-3-3m6-4l-3 3-3-3" />
    </svg>
    <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">التمارين</span>
</a>


<!-- ============================================= -->
<!-- الرابط 3: الآلات (Machines) -->
<!-- ============================================= -->
<a href="<?php echo e(route('user.machines')); ?>" 
    class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-orange-500
    <?php echo e(request()->routeIs('user.machines') ? 'bg-orange-700 text-white shadow-lg shadow-orange-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-orange-400'); ?>">
    <!-- أيقونة معدات/ترس (Gear/Equipment) -->
    <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('user.machines') ? 'text-white' : 'text-gray-500 group-hover:text-orange-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
    </svg>
    <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">الآلات</span>
</a>


<!-- ============================================= -->
<!-- الرابط 4: الاشتراكات (Subscriptions) -->
<!-- ============================================= -->
<a href="<?php echo e(route('user.subscriptions')); ?>" 
    class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-yellow-500
    <?php echo e(request()->routeIs('user.subscriptions') ? 'bg-yellow-700 text-white shadow-lg shadow-yellow-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-yellow-400'); ?>">
    <!-- أيقونة بطاقة دفع (Credit Card) -->
    <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('user.subscriptions') ? 'text-white' : 'text-gray-500 group-hover:text-yellow-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-1-5h2m-2-4h2" />
    </svg>
    <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">الاشتراكات</span>
</a>
    <!-- الرابط 4: جدولي وحصصي -->
    <a href="<?php echo e(route('user.me.program')); ?>" 
       class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500
       <?php echo e(request()->routeIs('schedule') ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'); ?>">
        <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('schedule') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">جدولي وحصصي</span>
    </a>

    <!-- الرابط 5: قياسات التقدم -->
    <a href="<?php echo e(route('user.progress')); ?>" 
       class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500
       <?php echo e(request()->routeIs('progress.metrics') ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'); ?>">
        <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('progress.metrics') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
        </svg>
        <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">قياسات التقدم</span>
    </a>

    <!-- الرابط 6: سجل الدفعات -->
    <a href="<?php echo e(route('user.payment')); ?>" 
       class="flex items-center p-3 rounded-xl transition-all duration-200 group relative transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-cyan-500
       <?php echo e(request()->routeIs('payments.history') ? 'bg-cyan-700 text-white shadow-lg shadow-cyan-500/30' : 'text-gray-400 hover:bg-gray-800 hover:text-cyan-400'); ?>">
        <svg class="w-6 h-6 z-10 <?php echo e(request()->routeIs('payments.history') ? 'text-white' : 'text-gray-500 group-hover:text-cyan-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM4 14s.5-2 3-2 3 2 3 2m6 0s.5-2 3-2 3 2 3 2"></path>
        </svg>
        <span x-show="isSidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.200ms class="mr-4 font-semibold text-base whitespace-nowrap z-10">سجل الدفعات</span>
    </a>

</nav>

            </div>
            
            <!-- تسجيل الخروج (في الأسفل) -->
            <nav class="space-y-2 pb-4 pt-8 border-t border-gray-800">

                <form method="POST" action="<?php echo e(route('user.logout')); ?>">
                    <?php echo csrf_field(); ?>

                    <button type="submit"
                        class="w-full flex items-center p-3 rounded-xl transition-all duration-200 group relative overflow-hidden 
                               text-gray-400 hover:bg-red-800/20 hover:text-red-500 transform hover:scale-[1.02] 
                               focus:outline-none focus:ring-2 focus:ring-red-500">

                        <svg class="w-6 h-6 z-10 text-gray-500 group-hover:text-red-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>

                        <!-- **الحل هنا: إضافة x-show="isSidebarOpen"** -->
                        <span x-show="isSidebarOpen"
                            x-transition:enter.duration.300ms
                            x-transition:leave.duration.200ms
                            class="mr-4 font-semibold text-base whitespace-nowrap z-10 text-gray-200 group-hover:text-red-500">
                            تسجيل الخروج
                        </span>

                    </button>
                </form>

            </nav>

        </aside>

        <!--
            2. المحتوى الرئيسي (Main Content) - يعرض بيانات العضو
        -->
    <main 
            :class="isSidebarOpen ? 'mr-20' : 'mr-20'" 
            class="flex-1 py-8 px-6 transition-all duration-300 ease-in-out w-full min-h-screen">
            
            <header class="mb-6">
                <h1 class="font-extrabold text-3xl text-cyan-400 tracking-wider border-b border-gray-800 pb-3">
                    مرحباً بك سيد <?php echo e(auth()->user()->name); ?> 🏋️
                </h1>
                <p class="text-gray-400 mt-2"> 
                    KOK GYM  مكان لبناء العظماء..... ادخل بعزم و اخرج بانتصار 
                </p>
            </header>

                <?php echo $__env->yieldContent('content'); ?>
    </main>


    </div>


<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

   <script src="https://cdn.tailwindcss.com"></script>

</body>
</html><?php /**PATH C:\Users\DELL\Desktop\projects\kokGym\resources\views/dashboard.blade.php ENDPATH**/ ?>