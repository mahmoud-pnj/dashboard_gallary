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
        Schema::create('albums_pic', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('album_id');
            $table->longText('name')->nullable(false);
            $table->string('picture');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums_pic');
    }
};
