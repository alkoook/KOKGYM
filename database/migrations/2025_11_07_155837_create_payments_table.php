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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('subscription_id')->nullable()->nullable()->constrained('subscriptions')->onDelete('set null');
            $table->foreignId('machine_id')->nullable()->nullable()->constrained('machines')->onDelete('set null');
            $table->foreignId('supplement_id')->nullable()->nullable()->constrained('supplements')->onDelete('set null');
            $table->decimal('amount');
            $table->dateTime('payment_date');
            $table->enum('type', ['expense', 'income']);
            $table->enum('payment_method', ['cash', 'card', 'transfer']);//طرقة الدفع
            $table->text('notes')->nullable();
            $table->timestamps(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
