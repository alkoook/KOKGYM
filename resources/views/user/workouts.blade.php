@extends('dashboard')

@section('title', 'الخطة التدريبية')

@section('content')
    <!-- عنوان الصفحة داخل المحتوى الرئيسي -->
    <h1 class="text-3xl font-extrabold text-white mb-6 border-b border-orange-500 pb-2">جدول التمارين الأسبوعي</h1>

    <!-- محتوى صفحة التمارين -->
    <div class="space-y-8">
        <p class="text-gray-300 text-lg">
            إليك خطتك التدريبية الحالية والمصممة خصيصاً لتحقيق أقصى استفادة من جلساتك الرياضية.
        </p>

        <!-- جدول التمارين الأسبوعي -->
        <div class="bg-gray-800 p-6 rounded-xl shadow-2xl overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider rounded-r-lg">
                            اليوم
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                            التركيز العضلي
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider rounded-l-lg">
                            الإجراءات
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    
                    <!-- السبت: الصدر والترايسبس -->
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">السبت</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                            الصدر والذراع الخلفية (Chest & Triceps)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>

                    <!-- الأحد: الظهر والبايسبس -->
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">الأحد</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                            الظهر والذراع الأمامية (Back & Biceps)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>

                    <!-- الاثنين: الأرجل (كامل) -->
                    <tr class="hover:bg-gray-700 transition duration-150 bg-gray-700/50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">الاثنين</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                            الأرجل (Legs - Quad & Hamstring)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>

                    <!-- الثلاثاء: راحة -->
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">الثلاثاء</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 italic">
                            راحة ونشاط خفيف (Active Rest)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                             <span class="text-xs text-gray-500 py-1 px-3">
                                لا يوجد تمرين رئيسي
                            </span>
                        </td>
                    </tr>
                    
                    <!-- الأربعاء: الأكتاف والبطن -->
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">الأربعاء</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                            الأكتاف والبطن (Shoulders & Abs)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>

                    <!-- الخميس: تمرين لكامل الجسم/كارديو -->
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">الخميس</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                            تمرين لكامل الجسم أو كارديو مكثف
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                عرض التفاصيل
                            </button>
                        </td>
                    </tr>
                    
                    <!-- الجمعة: راحة -->
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-white">الجمعة</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 italic">
                            راحة تامة وتعافي (Complete Rest)
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                             <span class="text-xs text-gray-500 py-1 px-3">
                                لا يوجد تمرين رئيسي
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- زر الإجراء الرئيسي -->
        <button class="mt-6 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-8 rounded-xl transition duration-300 shadow-xl shadow-orange-500/20 transform hover:scale-[1.02]">
            تعديل خطة التمارين
        </button>
    </div>
@endsection