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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 20);
            $table->string('description', 150);
            $table->integer('author_id');
            $table->integer('file_id');
            // $table->unsignedBigInteger('author_id');
            // $table->foreign('author_id')->references('id')->on('users');
            // $table->unsignedBigInteger('file_id');
            // $table->foreign('file_id')->references('id')->on('files');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
