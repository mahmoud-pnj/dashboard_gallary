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
        Schema::create('tasks_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('task_id')->default(0)->references('id')->on('tasks')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->default(0)->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes('deleted_at', 0);


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_users');
    }
};
