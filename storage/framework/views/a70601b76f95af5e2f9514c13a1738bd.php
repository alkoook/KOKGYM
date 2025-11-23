<?php $__env->startSection('title', 'الاشتراكات'); ?>


<?php $__env->startSection('content'); ?>
    <!-- محتوى صفحة الاشتراكات -->
    <div class="space-y-6">
        
        <!-- بطاقة عرض حالة الاشتراك الحالي -->
        <div class="bg-gray-700 p-6 rounded-xl shadow-2xl border-l-4 border-yellow-500 transition duration-300 hover:shadow-yellow-500/30">
            <h3 class="text-2xl font-bold text-yellow-400 mb-3">حالة الاشتراك الحالي</h3>
            
            <!-- بيانات الاشتراك -->
            <p class="text-lg text-white">النوع: اشتراك شهري بلاتينيوم</p>
            <p class="text-lg text-white">تاريخ الانتهاء: <span class="font-mono text-red-400">2026/01/15</span></p>
            <p class="text-sm text-gray-400 mt-2">متبقٍ: 65 يوماً</p>
        </div>
        
        <!-- قسم الإجراءات (التجديد والتغيير) -->
        <div class="flex flex-col sm:flex-row gap-4 mt-6">
            
            <!-- زر التجديد -->
            <button class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-gray-900 font-bold py-3 px-6 rounded-xl transition duration-300 shadow-lg transform hover:scale-[1.01]">
                تجديد الاشتراك
            </button>
            
            <!-- زر تغيير الباقة -->
            <button class="flex-1 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-gray-900 font-bold py-3 px-6 rounded-xl transition duration-300 shadow-md transform hover:scale-[1.01]">
                تغيير الباقة
            </button>
        </div>
        
        <!-- ملاحظة عن الدفعات السابقة -->
        <p class="text-sm text-gray-500 pt-4">
            للاطلاع على سجل الدفعات السابقة، يرجى زيارة قسم سجل الدفعات.
        </p>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/user/subscriptions.blade.php ENDPATH**/ ?>