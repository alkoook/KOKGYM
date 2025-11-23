<!-- تحديد عنوان الصفحة -->

<?php $__env->startSection('title', 'سجل الدفعات وإدارة الفواتير'); ?>

<?php $__env->startSection('content'); ?>

<div class="space-y-8 p-4 sm:p-0">

<!-- رأس الصفحة -->
<header class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700">
    <h1 class="text-3xl font-bold text-white leading-snug">سجل الدفعات وإدارة الفواتير</h1>
    <p class="text-gray-400 mt-2">يمكنك مراجعة جميع معاملاتك، إدارة اشتراكك الحالي، وتنزيل فواتيرك.</p>
</header>

<!-- قسم حالة الاشتراك -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- بطاقة حالة الاشتراك وتفاصيله -->
    <div class="md:col-span-2 bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 space-y-4">
        <h2 class="text-xl font-bold text-white border-b border-gray-700 pb-2 flex items-center justify-between">
            <span>حالة اشتراكك الحالي</span>
            <!-- شارة الحالة -->
            <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-900/50 text-green-400 border border-green-700">نشط</span>
        </h2>
        
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-400">الخطة الحالية:</p>
                <p class="text-white font-semibold">برنامج اللياقة الشامل (شهري)</p>
            </div>
            <div>
                <p class="text-gray-400">تاريخ التجديد التالي:</p>
                <p class="text-white font-semibold">15 ديسمبر 2025</p>
            </div>
            <div>
                <p class="text-gray-400">قيمة الاشتراك:</p>
                <p class="text-white font-semibold">$99.99 / شهر</p>
            </div>
            <div>
                <p class="text-gray-400">طريقة الدفع:</p>
                <p class="text-white font-semibold">بطاقة تنتهي بـ **** 4567</p>
            </div>
        </div>
        
        <a href="#" class="inline-block mt-4 px-4 py-2 bg-cyan-600 text-white font-medium rounded-lg hover:bg-cyan-500 transition-colors shadow-md shadow-cyan-600/30">
            إدارة طرق الدفع والاشتراك
        </a>
    </div>

    <!-- بطاقة الإجمالي المدفوع -->
    <div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 flex flex-col justify-center items-center text-center">
        <p class="text-gray-400 text-lg">الإجمالي المدفوع حتى الآن:</p>
        <p class="text-5xl font-extrabold text-cyan-400 mt-2">$599.94</p>
        <p class="text-sm text-gray-500 mt-1">6 دفعات ناجحة</p>
    </div>
</div>

<!-- قسم سجل الدفعات -->
<div class="bg-gray-800 p-6 rounded-xl shadow-2xl border border-gray-700 space-y-4">
    <h2 class="text-xl font-bold text-white border-b border-gray-700 pb-2">سجل الدفعات الأخيرة</h2>
    
    <!-- جدول الدفعات Responsive -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        التاريخ
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        الوصف
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        المبلغ
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">
                        الحالة
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">الفاتورة</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                
                <!-- صف دفعة ناجحة -->
                <tr class="hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        15 أكتوبر 2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        تجديد اشتراك نوفمبر
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-semibold">
                        $99.99
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900/50 text-green-400">
                            ناجحة
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-cyan-400 hover:text-cyan-300">تنزيل الفاتورة</a>
                    </td>
                </tr>
                
                <!-- صف دفعة ناجحة أخرى -->
                <tr class="hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        15 سبتمبر 2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        تجديد اشتراك أكتوبر
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-semibold">
                        $99.99
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-900/50 text-green-400">
                            ناجحة
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-cyan-400 hover:text-cyan-300">تنزيل الفاتورة</a>
                    </td>
                </tr>

                <!-- صف دفعة مرفوضة -->
                <tr class="hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        15 أغسطس 2025
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                        تجديد اشتراك سبتمبر
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-semibold">
                        $99.99
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-900/50 text-red-400">
                            مرفوضة
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-red-400 hover:text-red-300 font-bold">إعادة المحاولة</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <a href="#" class="inline-block mt-4 text-cyan-400 hover:text-cyan-300 transition-colors text-sm font-medium">
        عرض كل الدفعات السابقة &rarr;
    </a>
</div>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/user/payment.blade.php ENDPATH**/ ?>