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
        Schema::create('film_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('id_video');
            $table->integer('id_tag');
            $table->timestamps();

            $table->foreign('id_video')->references('id')->on('videos');
            $table->foreign('id_tag')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_tags');
    }
};
