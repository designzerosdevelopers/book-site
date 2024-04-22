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
        if (!Schema::hasTable('homepage')) {
            Schema::create('homepage', function (Blueprint $table) {
                $table->id();
                $table->string('hero_heading');
                $table->text('hero_paragraph');
                $table->string('hero_image');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage');
    }
};
