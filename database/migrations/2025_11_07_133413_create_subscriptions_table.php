<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->bigIncrements('id');
        
        // ربط الاشتراك بنوع الخطة
        $table->foreignId('membership_id')
            ->constrained('memberships') // يربط بجدول memberships
            ->onDelete('restrict'); // لا يمكن حذف خطة إذا كان هناك اشتراكات مرتبطة بها

        // ربط الاشتراك بالعضو (إذا كان جدول المستخدمين هو 'users')
        // لاحظ: في مشروع النادي، يفضل أن يكون لديك جدول 'members' (الأعضاء) منفصل عن 'users' (الموظفين/المدراء)
        $table->foreignId('user_id')
            ->constrained('users') // إذا كنت تستخدم جدول users للأعضاء
            ->onDelete('cascade');
        
        $table->date('start_date'); // تاريخ بدء الاشتراك
        $table->date('end_date'); // تاريخ انتهاء الاشتراك (يُحسب بناءً على duration_days)
        
        // إضافة حقل لتتبع إذا كان الاشتراك فعالاً
        $table->boolean('is_active')->default(true); 

        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
