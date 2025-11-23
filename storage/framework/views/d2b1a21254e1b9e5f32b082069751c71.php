<?php $__env->startSection('title', 'إدارة الأجهزة والمعدات'); ?>

<?php $__env->startSection('content'); ?>
    <!-- عنوان الصفحة داخل المحتوى الرئيسي -->
    <h1 class="text-3xl font-extrabold text-white mb-6 border-b border-sky-500 pb-2">قائمة أجهزة النادي</h1>

    <!-- محتوى صفحة الأجهزة -->
    <div class="space-y-8">
        <p class="text-gray-300 text-lg">
            تصفح المعدات المتاحة في صالتك الرياضية، واطلع على أهم الأجهزة.
        </p>

        <!-- شبكة عرض فئات الأجهزة -->
        <div class="grid grid-cols-1">
            
<div class="grid grid-cols-1">

 <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('machines-list', []);

$key = null;

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1879252413-0', null);

$__html = app('livewire')->mount($__name, $__params, $key);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>


</div>

        </div>

        <!-- زر الإجراء الرئيسي -->
        <button class="mt-8 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-xl transition duration-300 shadow-xl shadow-sky-500/20 transform hover:scale-[1.02] border border-sky-500/50">
            البحث عن جهاز معين
        </button>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/user/machines.blade.php ENDPATH**/ ?>