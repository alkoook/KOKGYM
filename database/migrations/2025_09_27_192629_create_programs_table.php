<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('اسم البرنامج التدريبي');
            $table->text('description')->nullable()->comment('وصف البرنامج');
            $table->foreignId('assign_to')->nullable()->constrained('users')->onDelete('cascade');
            
            // المدرب الذي أنشأ البرنامج
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null')->comment('مفتاح المدرب');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }};