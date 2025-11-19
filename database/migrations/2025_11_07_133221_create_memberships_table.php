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
    Schema::create('memberships', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name')->unique(); // اسم الخطة: (مثلاً: الباقة الذهبية، الاشتراك الشهري)
        $table->unsignedInteger('duration_days'); // المدة بالأيام (مثلاً: 30، 90، 365)
        $table->decimal('price', 8, 2); // سعر الخطة
        $table->boolean('is_active')->default(true); // للتفعيل أو الإلغاء
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
