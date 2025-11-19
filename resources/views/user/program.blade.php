@extends('dashboard')

<!-- تحديد عنوان الصفحة الذي سيظهر في الرأس العلوي أو أي مكان مخصص للعناوين في قالب dashboard -->

@section('title', 'برامجنا التدريبية')

@section('content')

<div class="space-y-8 p-4 sm:p-0">

<h1 class="text-4xl font-extrabold text-white mb-6 border-b border-cyan-700 pb-3">تصفح البرامج المتاحة</h1>

<!-- قسم المرشحات والبحث - تصميم عصري -->
<div class="flex flex-col md:flex-row justify-between items-center gap-4 p-4 bg-gray-800 rounded-xl shadow-2xl shadow-gray-900/50 border border-gray-700">
    <div class="w-full md:w-1/2">
        <input type="text" placeholder="ابحث عن برنامج باسم، مستوى أو هدف..." 
               class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 placeholder-gray-400 
                      focus:ring-cyan-500 focus:border-cyan-500 transition-all text-sm" 
               aria-label="Search Programs" />
    </div>
    <div class="w-full md:w-1/4">
        <select class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:ring-cyan-500 focus:border-cyan-500 transition-all text-sm">
            <option selected disabled>تصفية حسب المستوى</option>
            <option value="all">كل المستويات</option>
            <option value="beginner">للمبتدئين</option>
            <option value="intermediate">متوسط</option>
            <option value="advanced">متقدم</option>
        </select>
    </div>
</div>

<!-- شبكة عرض البرامج - تصميم بطاقات متجاوب وجذاب -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    
    @php
        // بيانات وهمية للبرامج
        $programs = [
            ['title' => 'تحول اللياقة الشامل', 'level' => 'للمبتدئين', 'duration' => '12 أسبوع', 'color' => 'cyan', 'description' => 'بناء قاعدة قوية للياقة البدنية وزيادة الطاقة العامة.'],
            ['title' => 'تحدي القوة العضلية', 'level' => 'متقدم', 'duration' => '8 أسابيع', 'color' => 'fuchsia', 'description' => 'تركيز مكثف على رفع الأثقال لزيادة الكتلة والقوة.'],
            ['title' => 'خطة حرق الدهون 30', 'level' => 'متوسط', 'duration' => '30 يوم', 'color' => 'red', 'description' => 'نظام غذائي وتدريبي لتسريع عملية الأيض وحرق الدهون.'],
            ['title' => 'اليوغا واللياقة الذهنية', 'level' => 'كل المستويات', 'duration' => '10 أسابيع', 'color' => 'teal', 'description' => 'زيادة المرونة، تحسين التوازن، والحد من التوتر اليومي.'],
        ];
    @endphp

    @foreach($programs as $program)
        @php 
            $base_color = $program['color'];
            $ring_color = "ring-{$base_color}-500";
            $text_color = "text-{$base_color}-400";
            $bg_badge = "bg-{$base_color}-900/50";
            $bg_button = "bg-{$base_color}-600";
            $hover_button = "hover:bg-{$base_color}-500";
        @endphp

        <!-- بطاقة البرنامج -->
        <div class="bg-gray-800 rounded-xl overflow-hidden shadow-2xl transition-all duration-300 hover:{{ $ring_color }} hover:shadow-xl hover:shadow-{{ $base_color }}-500/30 transform hover:scale-[1.02] border border-gray-700">
            <div class="p-6 space-y-3">
                <div class="flex justify-between items-center">
                    <!-- شارة المستوى/الفئة -->
                    <span class="text-xs font-semibold uppercase tracking-wider {{ $text_color }} {{ $bg_badge }} px-3 py-1 rounded-full whitespace-nowrap">{{ $program['level'] }}</span>
                    <!-- المدة -->
                    <span class="text-sm font-bold text-green-400">{{ $program['duration'] }}</span>
                </div>
                
                <!-- عنوان البرنامج -->
                <h3 class="text-2xl font-bold text-white leading-tight">{{ $program['title'] }}</h3>
                
                <!-- وصف البرنامج -->
                <p class="text-gray-400 text-sm h-12 overflow-hidden">{{ $program['description'] }}</p>
                
                <!-- تقييم وهمي -->
                <div class="flex items-center text-gray-300 pt-2">
                    <svg class="w-5 h-5 ml-1 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="text-sm">4.7 / 5</span>
                </div>
            </div>

            <!-- زر الإجراء -->
            <div class="p-4 bg-gray-700 border-t border-gray-600">
                <a href="#" class="block w-full text-center px-4 py-2 {{ $bg_button }} text-white font-semibold rounded-lg {{ $hover_button }} transition-colors shadow-lg shadow-{{ $base_color }}-500/30">
                    عرض التفاصيل
                </a>
            </div>
        </div>
    @endforeach
    
</div>


</div>

@endsection