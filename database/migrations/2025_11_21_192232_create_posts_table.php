<?php
// database/migrations/2025_01_01_000000_create_posts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up()
{
Schema::create('posts', function (Blueprint $table) {
$table->id();
$table->string('title');
$table->text('body')->nullable();
$table->string('image')->nullable(); // nullable image
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('posts');
}
};
