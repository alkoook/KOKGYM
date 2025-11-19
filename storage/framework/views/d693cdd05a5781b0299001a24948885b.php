<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دخول الأعضاء</title>
    <!-- استدعاء Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* استخدام خط Inter لجميع النصوص */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        lime: {
                            400: '#A3E635', /* درجة لون الليموني الرئيسية */
                            500: '#84CC16',
                        },
                    },
                },
            },
        }
    </script>
</head>
<!-- خلفية سوداء عميقة ومحاذاة للوسط -->
<body class="bg-black flex items-center justify-center min-h-screen p-4 text-gray-100">

    <!-- البطاقة الرئيسية (Card) بتصميم داكن وحافة ليمونية -->
    <div class="w-full max-w-md p-8 space-y-8 bg-gray-900 rounded-xl shadow-2xl 
                 border-t-4 border-lime-400 transition-all duration-300 hover:shadow-lime-500/30">
        
        <h2 class="text-4xl font-extrabold text-center text-white pb-4 border-b border-gray-700">
            تسجيل دخول الأعضاء
        </h2>

        <!-- عرض رسائل الأخطاء بتصميم داكن -->
        <?php if($errors->any()): ?>
            <div class="bg-red-900/30 border-r-4 border-red-500 text-red-400 p-4 rounded-lg" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="font-medium">عفواً، هناك بعض الأخطاء:</p>
                </div>
                <ul class="mt-2 list-disc list-inside text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login.post')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            
            <!-- حقل معرف المستخدم (UID) الجديد -->
            <div>
                <label for="uid" class="block text-sm font-semibold text-gray-300 mb-1">معرف المستخدم (UID)</label>
                <input id="uid" name="uid" type="text" required 
                       class="mt-1 block w-full px-4 py-3 border border-gray-700 bg-gray-700 text-white rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-lime-400 transition duration-150 sm:text-base"
                       value="<?php echo e(old('uid')); ?>"
                       placeholder="ادخل معرف المستخدم الفريد">
            </div>

            <!-- حقل الإيميل -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-300 mb-1">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" required 
                       class="mt-1 block w-full px-4 py-3 border border-gray-700 bg-gray-700 text-white rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-lime-400 transition duration-150 sm:text-base"
                       value="<?php echo e(old('email')); ?>"
                       placeholder="ادخل بريدك الإلكتروني">
            </div>

            <!-- حقل كلمة السر -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-300 mb-1">كلمة السر</label>
                <input id="password" name="password" type="password" required 
                       class="mt-1 block w-full px-4 py-3 border border-gray-700 bg-gray-700 text-white rounded-lg shadow-sm placeholder-gray-400 
                              focus:outline-none focus:ring-2 focus:ring-lime-400 focus:border-lime-400 transition duration-150 sm:text-base"
                       placeholder="ادخل كلمة السر">
            </div>

            <!-- الحقل المخفي الضروري للتحقق من الدور -->
            <input type="hidden" name="role_attempt" value="member">

            <!-- زر تسجيل الدخول (Lime Accent) -->
            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-bold 
                               text-gray-900 bg-lime-400 hover:bg-lime-300 
                               focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-lime-400 focus:ring-offset-gray-900
                               transition duration-300 ease-in-out transform hover:scale-[1.01] hover:shadow-lime-400/50">
                    تسجيل الدخول
                </button>
            </div>
        </form>
        
        <div class="text-center pt-6 border-t border-gray-700">
            <p class="text-sm text-gray-400">
                هل أنت من فريق الإدارة ؟! <a href="admin/login" class="font-bold text-lime-400 hover:text-lime-300 transition duration-150">سجل الآن</a>
            </p>
        </div>
    </div>

</body>
</html><?php /**PATH C:\Users\DELL\Desktop\projects\kokGym\resources\views/login.blade.php ENDPATH**/ ?>