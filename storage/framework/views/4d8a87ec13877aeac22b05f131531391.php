<div class="text-center p-12 bg-gray-800 rounded-3xl shadow-2xl shadow-gray-950/50">

    <!-- الزر -->
    <button wire:click="show(<?php echo e($postId); ?>)"
        class="premium-button-v3 text-white font-bold py-3 px-12 rounded-lg text-lg uppercase tracking-widest 
               border border-indigo-300/30 cursor-pointer">
        عرض المزيد
    </button>

<!--[if BLOCK]><![endif]--><?php if($showDiv): ?>
<div class="mt-8 p-10 bg-gray-700 rounded-2xl shadow-2xl text-white">
    <h2 class="text-2xl font-bold mb-4"><?php echo e($post->title); ?></h2>

    
    <!--[if BLOCK]><![endif]--><?php if($post->image): ?>
        <img src="<?php echo e(asset('storage/posts/' . $post->image)); ?>"
             class="w-full h-60 object-cover rounded mb-4">
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <p class="text-gray-200 text-lg leading-7">
        <?php echo e($post->body); ?>

    </p>

    <button wire:click="hideDiv" class="mt-6 px-6 py-2 bg-red-600 rounded-lg">
        إغلاق
    </button>
</div>
<?php endif; ?><!--[if ENDBLOCK]><![endif]-->


</div>
<?php /**PATH C:\Users\DELL\Desktop\projects\kokGym\resources\views/livewire/show-post.blade.php ENDPATH**/ ?>