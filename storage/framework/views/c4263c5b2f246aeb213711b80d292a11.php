<?php $__env->startSection('title', 'قائمة التمارين المتاحة'); ?>

<?php $__env->startSection('content'); ?>

    

    <?php
        // هذا المتغير هو مساعد على مستوى العرض فقط لتنسيق الألوان
        $levelColors = [
            'beginner' => 'text-green-400 bg-green-900/50',
            'intermediate' => 'text-yellow-400 bg-yellow-900/50',
            'advanced' => 'text-red-400 bg-red-900/50',
        ];
    ?>

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

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $exercises; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exercise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-700 transition duration-150">
                            
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-white"><?php echo e($exercise->name); ?></p>
                                <p class="text-xs text-gray-400 mt-1 line-clamp-1" title="<?php echo e($exercise->description); ?>"><?php echo e($exercise->description); ?></p>
                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-400">
                                <?php echo e($exercise->category); ?>

                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                <?php
                                    $levelClass = $levelColors[$exercise->level] ?? 'text-gray-400 bg-gray-600/50';
                                ?>
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium <?php echo e($levelClass); ?>">
                                    <?php echo e($exercise->level); ?>

                                </span>
                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-cyan-400">
                                <?php echo e($exercise->machine->name ?? 'وزن الجسم'); ?>

                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                <?php echo e($exercise->creator->name ?? 'النظام'); ?>

                            </td>

                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="window.location.href='<?php echo e(url('/exercises/' . $exercise->id)); ?>'" class="text-xs bg-orange-600 hover:bg-orange-700 text-white py-1 px-3 rounded-full transition duration-150">
                                    عرض التفاصيل
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">
                                لا توجد تمارين متاحة حالياً. يرجى البدء بإضافة تمرين جديد.
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\resources\views/user/workouts.blade.php ENDPATH**/ ?>