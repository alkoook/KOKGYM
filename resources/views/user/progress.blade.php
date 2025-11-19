@extends('dashboard')

<!-- تحديد عنوان الصفحة -->

@section('title', 'تتبع التقدم والقياسات')

@section('content')

<div class="space-y-8 p-4 sm:p-0">

<!-- رأس الصفحة -->
<header class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
    <h1 class="text-3xl font-bold text-white leading-snug">تتبع القياسات والتقدم</h1>
    <p class="text-gray-400 mt-2">راقب تقدمك نحو أهدافك من خلال الرسوم البيانية وسجل القياسات التفصيلي.</p>
</header>

<!-- قسم المخطط البياني للوزن (نستخدم placeholder لعدم إمكانية تضمين مكتبات JS) -->
<div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
    <h2 class="text-xl font-bold text-white mb-4 border-b border-gray-700 pb-2">مخطط الوزن خلال الأشهر الستة الماضية</h2>
    
    <!-- Placeholder for Chart -->
    <div class="bg-gray-900 h-64 flex items-center justify-center rounded-lg border border-gray-700 p-4">
        <p class="text-gray-400 text-center text-lg">
            
            <br>
            سيتم عرض رسم بياني تفاعلي هنا لتتبع الوزن مع مرور الوقت.
        </p>
    </div>
    
    <div class="mt-4 flex justify-end space-x-4 rtl:space-x-reverse text-sm font-medium">
        <span class="text-gray-400">نطاق العرض:</span>
        <a href="#" class="text-cyan-400 hover:text-cyan-300 border-b border-cyan-400">6 أشهر</a>
        <a href="#" class="text-gray-400 hover:text-white">سنة واحدة</a>
        <a href="#" class="text-gray-400 hover:text-white">الكل</a>
    </div>
</div>

<!-- قسم القياسات الرئيسية (KPIs) -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
    
    <!-- بطاقة الوزن الحالي -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 text-center">
        <p class="text-gray-400">الوزن الحالي</p>
        <p class="text-4xl font-extrabold text-cyan-400 mt-2">85.3 <span class="text-xl font-semibold text-gray-500">كغ</span></p>
        <p class="text-xs text-green-400 mt-1 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 rtl:mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            -1.2 كغ (منذ آخر مرة)
        </p>
    </div>

    <!-- بطاقة محيط الخصر -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 text-center">
        <p class="text-gray-400">محيط الخصر</p>
        <p class="text-4xl font-extrabold text-white mt-2">92 <span class="text-xl font-semibold text-gray-500">سم</span></p>
        <p class="text-xs text-yellow-400 mt-1">
            لا تغيير منذ آخر مرة
        </p>
    </div>

    <!-- بطاقة دهون الجسم (مثال) -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 text-center">
        <p class="text-gray-400">دهون الجسم التقديرية</p>
        <p class="text-4xl font-extrabold text-white mt-2">18.5 <span class="text-xl font-semibold text-gray-500">%</span></p>
        <p class="text-xs text-green-400 mt-1 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 rtl:mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            -0.5% (منذ آخر مرة)
        </p>
    </div>
    
     <!-- بطاقة هدف الوزن (Target) -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 text-center">
        <p class="text-gray-400">الهدف المحدد</p>
        <p class="text-4xl font-extrabold text-fuchsia-400 mt-2">75.0 <span class="text-xl font-semibold text-gray-500">كغ</span></p>
        <p class="text-xs text-gray-400 mt-1">
            المتبقي للوصول للهدف: 10.3 كغ
        </p>
    </div>
</div>

<!-- قسم إضافة قياس جديد -->
<div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
    <h2 class="text-xl font-bold text-white mb-4 border-b border-gray-700 pb-2">إضافة قياس جديد</h2>
    
    <form class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- حقل الوزن -->
        <div>
            <label for="weight" class="block text-sm font-medium text-gray-400 mb-1">الوزن (كغ)</label>
            <input type="number" id="weight" name="weight" step="0.1" placeholder="85.0" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:ring-cyan-500 focus:border-cyan-500">
        </div>
        
        <!-- حقل محيط الخصر -->
        <div>
            <label for="waist" class="block text-sm font-medium text-gray-400 mb-1">محيط الخصر (سم)</label>
            <input type="number" id="waist" name="waist" step="1" placeholder="92" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:ring-cyan-500 focus:border-cyan-500">
        </div>

         <!-- حقل تاريخ القياس -->
        <div>
            <label for="date" class="block text-sm font-medium text-gray-400 mb-1">تاريخ القياس</label>
            <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}" class="w-full p-3 bg-gray-900 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:ring-cyan-500 focus:border-cyan-500">
        </div>
        
        <!-- زر الإضافة -->
        <div class="md:col-span-3 pt-2">
            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-cyan-600 text-white font-semibold rounded-lg hover:bg-cyan-500 transition-colors shadow-lg shadow-cyan-600/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline ml-2 rtl:mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                حفظ القياس الجديد
            </button>
        </div>
    </form>
</div>

<!-- قسم سجل القياسات المفصل -->
<div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
    <h2 class="text-xl font-bold text-white mb-4 border-b border-gray-700 pb-2">سجل القياسات التفصيلي</h2>
    
    <!-- جدول سجل القياسات -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        التاريخ
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        الوزن (كغ)
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        محيط الخصر (سم)
                    </th>
                     <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        دهون الجسم (%)
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">الإجراء</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                
                <!-- صف القياس الأخير -->
                <tr class="bg-gray-700/50 hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-cyan-400">
                        اليوم (20 نوفمبر 2025)
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                        85.3
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                        92
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-white">
                        18.5
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-red-400 hover:text-red-300">حذف</a>
                    </td>
                </tr>
                
                <!-- صف قياس سابق -->
                <tr class="hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        10 أكتوبر 2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        86.5
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        92
                    </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        19.0
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-red-400 hover:text-red-300">حذف</a>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>

    <a href="#" class="inline-block mt-4 text-cyan-400 hover:text-cyan-300 transition-colors text-sm font-medium">
        عرض كل القياسات السابقة &rarr;
    </a>
</div>


</div>

@endsection