@extends('dashboard')

@section('title', 'قائمة التمارين المتاحة')

@section('content')

    {{--
        ************************************************************************
        تعليمات المتحكم (Controller) - هذا الملف يعتمد على البيانات القادمة من المتحكم:

        1. يجب أن يقوم المتحكم بتمرير المتغير $exercises إلى هذا العرض (View).
        2. يجب تحميل علاقات user_id و machine_id مسبقاً (Eager Loading) لضمان العمل السريع:

        use App\Models\Exercise;
        $exercises = Exercise::with(['user', 'machine'])->get();
        return view('exercises', compact('exercises'));
        ************************************************************************
    --}}

    @php
        // هذا المتغير هو مساعد على مستوى العرض فقط لتنسيق الألوان
        $levelColors = [
            'beginner' => 'text-green-400 bg-green-900/50',
            'intermediate' => 'text-yellow-400 bg-yellow-900/50',
            'advanced' => 'text-red-400 bg-red-900/50',
        ];
    @endphp

    <!-- عنوان الصفحة داخل المحتوى الرئيسي -->
    <h1 class="text-3xl font-extrabold text-white mb-6 border-b border-orange-500 pb-2">قائمة التمارين المتاحة</h1>

    <!-- محتوى صفحة التمارين -->
    <div class="space-y-8">
        <p class="text-gray-300 text-lg">
            هذه قائمة بجميع التمارين المتاحة في النظام، مرتبطة بالآلة ومستوى الصعوبة.
        </p>

        <!-- جدول التمارين المتاحة -->
        <div class="bg-gray-800 p-6 rounded-xl shadow-2xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider rounded-r-lg">
                            اسم التمرين والوصف
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                            الفئة
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                            المستوى
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                            الآلة
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                            المُضيف
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider rounded-l-lg">
                            الإجراءات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">

                    {{-- استخدام المتغير $exercises القادم من المتحكم --}}
                    @forelse ($exercises as $exercise)
                        <tr class="hover:bg-gray-700 transition duration-150">
                            {{-- 1. اسم التمرين والوصف --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-white">{{ $exercise->name }}</p>
                                <p class="text-xs text-gray-400 mt-1 line-clamp-1" title="{{ $exercise->description }}">{{ $exercise->description }}</p>
                            </td>

                            {{-- 2. الفئة (category) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                                {{ $exercise->category }}
                            </td>

                            {{-- 3. المستوى (level) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                @php
                                    $levelClass = $levelColors[$exercise->level] ?? 'text-gray-400 bg-gray-600/50';
                                @endphp
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium {{ $levelClass }}">
                                    {{ $exercise->level }}
                                </span>
                            </td>

                            {{-- 4. الآلة المستخدمة (machine_id -> machine->name) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-cyan-400">
                                {{ $exercise->machine->name ?? 'وزن الجسم' }}
                            </td>

                            {{-- 5. أضيف بواسطة (user_id -> user->name) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $exercise->creator->name ?? 'النظام' }}
                            </td>

                            {{-- 6. الإجراءات (عرض التفاصيل/الفيديو) --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="window.location.href='{{ url('/exercises/' . $exercise->id) }}'" class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                    عرض التفاصيل
                                </button>
                            </td>
                        </tr>
                    @empty
                        {{-- في حال عدم وجود تمارين --}}
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">
                                لا توجد تمارين متاحة حالياً. يرجى البدء بإضافة تمرين جديد.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection
