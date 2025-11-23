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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            {{-- 🛑 حلقة التكرار لجلب البيانات من جدول 'supplements' 🛑 --}}
            @foreach ($supplements as $supplement)
            <!-- بطاقة مكمل ديناميكية محسّنة ومضيئة -->
            <div class="group relative p-5 bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-green-500/10
                        hover:shadow-green-500/80 transition duration-500 transform hover:scale-[1.03] overflow-hidden">

                <!-- طبقة التوهج الخفية (لجعل البطاقة أكثر حيوية) -->
                <div class="absolute inset-0 bg-green-900/10 opacity-0 group-hover:opacity-100 transition duration-500" aria-hidden="true"></div>

                <!-- 1. مساحة الصورة -->
                <div class="mb-4 relative z-10">
                    @if ($supplement->image)
                        <img src="{{ asset('/storage/supplements/'.$supplement->image) }}" alt="{{ $supplement->name }}"
                             class="w-full h-40 object-cover rounded-lg shadow-xl border-2 border-green-500/50 group-hover:border-green-400 transition duration-300">
                    @else
                        <!-- Placeholder في حال عدم وجود صورة -->
                        <div class="h-32 bg-gray-700 flex flex-col items-center justify-center rounded-lg border border-dashed border-gray-500 text-gray-500">
                            <svg class="w-8 h-8 text-green-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs">لا توجد صورة متاحة</span>
                        </div>
                    @endif
                </div>

                <!-- 2. اسم المكمل + السعر -->
                <div class="flex justify-between items-start mb-2 relative z-10">
                    <h3 class="text-xl font-bold text-green-400 group-hover:text-green-300 transition duration-300">{{ $supplement->name }}</h3>

                    <!-- عرض سعر البيع بطريقة مضيئة -->
                    <p class="text-2xl font-extrabold text-white bg-green-600 px-3 py-1 rounded-lg shadow-xl shadow-green-400/70 transform -rotate-2 group-hover:rotate-0 transition duration-300">
                        {{ number_format($supplement->sale_price, 2) }} $
                    </p>
                </div>

                <!-- 3. الهدف من الاستخدام (Purpose) - التأثير المضيء والمشع -->
                <div class="mb-4 relative z-10">
                    <span class="inline-block px-4 py-1 text-sm font-extrabold text-white rounded-full
                                  bg-green-700 shadow-xl shadow-green-500/80
                                  animate-pulse-slow cursor-default transition duration-300 hover:shadow-green-300/90">
                        {{ $supplement->purpose ?? $supplement->type }}
                    </span>
                </div>

                <!-- 4. الوصف -->
                <p class="text-sm text-gray-300 mt-4 mb-4 leading-relaxed relative z-10 line-clamp-3">
                    {{ $supplement->description }}
                </p>

                <!-- 5. تفاصيل إضافية (الكمية والنوع) -->
                <div class="pt-3 border-t border-gray-700 mt-3 text-xs text-gray-400 relative z-10">
                    <div class="flex justify-between font-medium">
                        <p>النوع: <span class="text-green-300 font-semibold">{{ $supplement->type }}</span></p>
                        <p>المخزون: <span class="text-green-300 font-semibold">{{ $supplement->quantity }} قطعة</span></p>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- في حالة عدم وجود مكملات --}}
            @empty($supplements)
                <p class="text-lg text-gray-400 col-span-full text-center py-10 bg-gray-800 rounded-xl">لا يوجد مكملات متاحة حالياً للعرض.</p>
            @endempty

        </div>

    </div>
@endsection
