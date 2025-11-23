<div class="grid grid-cols-3  gap-8">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $machines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $machine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div class="p-8 bg-gray-700 rounded-2xl shadow-xl border-b-4 border-sky-500 hover:shadow-sky-500/30 transition duration-300 transform hover:-translate-y-1">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($machine->image): ?>
                <img src="<?php echo e(asset('storage/machines/' . $machine->image)); ?>" 
                     class="w-full h-56 object-cover rounded-xl mb-5 border border-gray-600">
            <?php else: ?>
                <div class="w-full h-56 bg-gray-600 rounded-xl mb-5 flex items-center justify-center text-gray-400">
                    لا توجد صورة
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <h3 class="text-xl font-semibold text-sky-400 mb-3">
                <?php echo e($machine->name); ?>

            </h3>

            <p class="text-sm text-gray-300 mb-1">
                <span class="font-bold text-sky-300">بلد المنشأ:</span>
                <?php echo e($machine->origin_country ?: 'غير محدد'); ?>

            </p>

            <p class="text-sm text-gray-300 mb-4">
                <span class="font-bold text-sky-300">السعر:</span>
                <?php echo e(number_format($machine->price, 2)); ?>$
            </p>

            <button class="w-full bg-sky-600 hover:bg-sky-700 text-white py-2 rounded-lg text-sm font-bold transition duration-150">
                تفاصيل الجهاز
            </button>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-gray-400 col-span-full text-center text-lg">لا يوجد أجهزة مضافة بعد.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/livewire/machines-list.blade.php ENDPATH**/ ?>