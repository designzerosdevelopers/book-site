<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('custom_code', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->tinyInteger('file')->default(0);
            $table->string('for');
            $table->string('link')->nullable();
            $table->timestamps();
        });

        DB::table('custom_code')->insert([
            [
                'type' => 'Stylesheet',
                'file' => 1,
                'for' => 'For Head Section',
                'link' => 'clientside/js-css-other//bootstrap.min.css',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Stylesheet',
                'file' => 1,
                'for' => 'For Head Section',
                'link' => 'clientside/js-css-other//style.css',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'JavaScript',
                'file' => 1,
                'for' => 'For Footer Section',
                'link' => 'clientside/js-css-other//bootstrap.bundle.min.js',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Stylesheet',
                'file' => 0,
                'for' => 'For Head Section',
                'link' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_code');
    }
};
