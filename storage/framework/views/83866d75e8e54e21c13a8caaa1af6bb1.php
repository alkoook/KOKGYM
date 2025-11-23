<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildSchema()); ?>

</div>
<?php /**PATH C:\Users\S I N O\Desktop\projects\KOKGYM\vendor\filament\schemas\resources\views/components/grid.blade.php ENDPATH**/ ?>