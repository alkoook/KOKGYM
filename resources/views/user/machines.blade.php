@extends('dashboard')

@section('title', 'إدارة الأجهزة والمعدات')

@section('content')
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

 <livewire:machines-list />


</div>

        </div>

        <!-- زر الإجراء الرئيسي -->
        <button class="mt-8 bg-gray-600 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded-xl transition duration-300 shadow-xl shadow-sky-500/20 transform hover:scale-[1.02] border border-sky-500/50">
            البحث عن جهاز معين
        </button>
    </div>
@endsection