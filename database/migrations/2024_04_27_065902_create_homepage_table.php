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
        Schema::create('homepage', function (Blueprint $table) {
            $table->id();
            $table->string('hero_heading')->nullable();
            $table->text('hero_paragraph')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('ps_title')->nullable();
            $table->string('ps_description')->nullable();
            $table->string('wcu_title')->nullable();
            $table->text('wcu_description')->nullable();
            $table->string('wcu_feature_1_title')->nullable();
            $table->string('wcu_feature_1_description')->nullable();
            $table->string('wcu_feature_2_title')->nullable();
            $table->string('wcu_feature_2_description')->nullable();
            $table->string('wcu_feature_3_title')->nullable();
            $table->string('wcu_feature_3_description')->nullable();
            $table->string('wcu_feature_4_title')->nullable();
            $table->string('wcu_feature_4_description')->nullable();
            $table->string('wh_title')->nullable();
            $table->text('wh_description')->nullable();
            $table->string('wh_feature_1')->nullable();
            $table->string('wh_feature_2')->nullable();
            $table->string('wh_feature_3')->nullable();
            $table->string('wh_feature_4')->nullable();
            $table->string('about_hs_title')->nullable();
            $table->string('about_hs_description')->nullable();
            $table->string('contact_hs_title')->nullable();
            $table->string('contact_hs_description')->nullable();
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage');
    }
};
