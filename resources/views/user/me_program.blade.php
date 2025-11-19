@extends('dashboard')

<!-- تحديد عنوان الصفحة -->

@section('title', 'برنامجي الحالي: تحول اللياقة الشامل')

@section('content')

<div class="space-y-8 p-4 sm:p-0">

<!-- رأس الصفحة وعنوان البرنامج -->
<header class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
        <h1 class="text-3xl font-bold text-white leading-snug">برنامجي النشط: تحول اللياقة الشامل</h1>
        <!-- شارة حالة البرنامج -->
        <span class="mt-3 md:mt-0 px-4 py-1.5 text-sm font-semibold rounded-full bg-cyan-900/50 text-cyan-400 border border-cyan-700">قيد التقدم</span>
    </div>
    <p class="text-gray-400 mt-2">مرحباً بعودتك! لنستعرض تقدمك في برنامج 12 أسبوعًا.</p>
</header>

<!-- بطاقة نظرة عامة على التقدم -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- بطاقة التقدم الكلي -->
    <div class="lg:col-span-2 bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 space-y-4">
        <h2 class="text-xl font-bold text-white border-b border-gray-700 pb-2">ملخص التقدم</h2>
        
        <div class="flex items-center justify-between">
            <span class="text-lg font-semibold text-white">التقدم الكلي في البرنامج</span>
            <span class="text-3xl font-extrabold text-cyan-400">55%</span>
        </div>

        <!-- شريط التقدم العصري -->
        <div class="w-full bg-gray-700 rounded-full h-3.5">
            <div class="bg-cyan-500 h-3.5 rounded-full transition-all duration-1000" style="width: 55%"></div>
        </div>
        
        <!-- إحصائيات سريعة -->
        <div class="grid grid-cols-3 gap-4 pt-4 text-center">
            <div>
                <p class="text-2xl font-bold text-green-400">6</p>
                <p class="text-sm text-gray-400">أسابيع مكتملة</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-white">18</p>
                <p class="text-sm text-gray-400">تمرين متبقي</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-yellow-400">1200</p>
                <p class="text-sm text-gray-400">نقطة مكافأة</p>
            </div>
        </div>
    </div>

    <!-- بطاقة التمرين التالي (Call to Action) -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 flex flex-col justify-between">
        <h2 class="text-xl font-bold text-white border-b border-gray-700 pb-2">تمرينك التالي</h2>
        <div class="space-y-3 pt-4">
            <p class="text-3xl font-extrabold text-white">اليوم 3 | القوة السفلية</p>
            <p class="text-gray-400 text-sm">التمرين مخصص لعضلات الساقين والأرداف، المدة المتوقعة 45 دقيقة.</p>
        </div>
        <button class="w-full mt-4 px-4 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-500 transition-colors shadow-lg shadow-green-500/30">
            ابدأ التمرين الآن <i class="fas fa-play mr-2"></i>
        </button>
    </div>
</div>

<!-- قسم الوحدات والمراحل -->
<div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 space-y-4">
    <h2 class="text-xl font-bold text-white border-b border-gray-700 pb-2">مراحل البرنامج (الأسابيع)</h2>

    <!-- قائمة المراحل -->
    <div class="space-y-3">
        
        <!-- مرحلة مكتملة -->
        <div class="flex items-center justify-between p-4 bg-gray-700/50 rounded-lg hover:bg-gray-700 transition-colors cursor-pointer">
            <div class="flex items-center space-x-4 space-x-reverse">
                <span class="text-2xl text-green-400">
                    <i class="fas fa-check-circle"></i>
                </span>
                <span class="text-white font-medium">الأسبوع 1-4: بناء الأساس</span>
            </div>
            <span class="text-sm text-green-400 font-semibold">مكتمل</span>
        </div>

        <!-- المرحلة الحالية -->
        <div class="flex items-center justify-between p-4 bg-cyan-900/30 rounded-lg border border-cyan-600 shadow-lg shadow-cyan-900/50 cursor-pointer">
            <div class="flex items-center space-x-4 space-x-reverse">
                <span class="text-2xl text-cyan-400">
                    <i class="fas fa-running"></i>
                </span>
                <span class="text-white font-bold">الأسبوع 5-8: كثافة أعلى</span>
            </div>
            <span class="text-sm text-cyan-400 font-bold">50%</span>
        </div>

        <!-- مرحلة قادمة -->
        <div class="flex items-center justify-between p-4 bg-gray-700/50 rounded-lg hover:bg-gray-700 transition-colors cursor-not-allowed opacity-70">
            <div class="flex items-center space-x-4 space-x-reverse">
                <span class="text-2xl text-gray-500">
                    <i class="fas fa-lock"></i>
                </span>
                <span class="text-gray-400 font-medium">الأسبوع 9-12: التثبيت والنتائج</span>
            </div>
            <span class="text-sm text-gray-500 font-semibold">مغلق</span>
        </div>

    </div>
    
    <a href="#" class="inline-block mt-4 text-cyan-400 hover:text-cyan-300 transition-colors text-sm font-medium">
        عرض جميع الوحدات والمحتوى التفصيلي &rarr;
    </a>
</div>


</div>

@endsection