@extends('dashboard')

@section('title', 'المكملات الغذائية')
{{-- افتراضاً أن هيكل dashboard يسمح بتعريف عنوان الصفحة --}}

@section('content')
    <!-- عنوان الصفحة داخل المحتوى الرئيسي -->
    <h1 class="text-3xl font-extrabold text-white mb-6 border-b border-green-500 pb-2">قائمة المكملات المتاحة</h1>

    <!-- محتوى صفحة المكملات الغذائية -->
    <div class="space-y-8">
        <p class="text-gray-300 text-lg">
            هنا يمكنك تصفح وإدارة جميع المكملات الغذائية الموصى بها، والاطلاع على دور كل منها في خطتك التدريبية.
        </p>
        
        <!-- شبكة عرض المكملات -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- بطاقة مكمل 1: بروتين مصل اللبن -->
            <div class="p-6 bg-gray-700 rounded-xl shadow-lg border-b-4 border-green-500 hover:shadow-green-500/30 transition duration-300 transform hover:translate-y-[-2px]">
                <h3 class="text-xl font-semibold text-green-400 mb-2">بروتين مصل اللبن (Whey Protein)</h3>
                <p class="text-sm text-gray-400 mb-3">
                    المصدر الأساسي والحيوي للبروتين بعد التمرين. يساعد في تعافي العضلات ونموها بسرعة.
                </p>
                <span class="inline-block px-3 py-1 text-xs font-bold bg-green-900 text-green-300 rounded-full">
                    لنمو العضلات
                </span>
            </div>
            
            <!-- بطاقة مكمل 2: كرياتين مونوهيدرات -->
            <div class="p-6 bg-gray-700 rounded-xl shadow-lg border-b-4 border-green-500 hover:shadow-green-500/30 transition duration-300 transform hover:translate-y-[-2px]">
                <h3 class="text-xl font-semibold text-green-400 mb-2">كرياتين مونوهيدرات (Creatine)</h3>
                <p class="text-sm text-gray-400 mb-3">
                    يعمل على زيادة مخزون الطاقة السريعة في العضلات، مما يزيد من القوة والأداء أثناء الرفع.
                </p>
                <span class="inline-block px-3 py-1 text-xs font-bold bg-green-900 text-green-300 rounded-full">
                    زيادة القوة والأداء
                </span>
            </div>
            
            <!-- بطاقة مكمل 3: الأحماض الأمينية متفرعة السلسلة (BCAAs) -->
            <div class="p-6 bg-gray-700 rounded-xl shadow-lg border-b-4 border-green-500 hover:shadow-green-500/30 transition duration-300 transform hover:translate-y-[-2px]">
                <h3 class="text-xl font-semibold text-green-400 mb-2">BCAAs</h3>
                <p class="text-sm text-gray-400 mb-3">
                    لتقليل التعب العضلي أثناء التمرين الطويل ومنع هدم العضلات.
                </p>
                <span class="inline-block px-3 py-1 text-xs font-bold bg-green-900 text-green-300 rounded-full">
                    تقليل التعب
                </span>
            </div>
        </div>
        
        <!-- زر الإجراء الرئيسي -->
        <button class="mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl transition duration-300 shadow-xl shadow-green-500/20 transform hover:scale-[1.02]">
            إضافة مكمل جديد أو البحث
        </button>
    </div>
@endsection