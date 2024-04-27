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
        if (!Schema::hasTable('homepage')) {
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
                $table->timestamps();
            });

            DB::table('homepage')->insert([
                'hero_heading' => 'Welcome to Our Website',
                'hero_paragraph' => 'Discover amazing features and services we offer.',
                'hero_image' => 'path/to/your/image.jpg',
                'ps_title' => 'Our Services',
                'ps_description' => 'Explore our range of services tailored to meet your needs.',
                'wcu_title' => 'Why Choose Us?',
                'wcu_description' => 'We provide innovative solutions with exceptional quality.',
                'wcu_feature_1_title' => 'Feature 1',
                'wcu_feature_1_description' => 'Description of Feature 1',
                'wcu_feature_2_title' => 'Feature 2',
                'wcu_feature_2_description' => 'Description of Feature 2',
                'wcu_feature_3_title' => 'Feature 3',
                'wcu_feature_3_description' => 'Description of Feature 3',
                'wcu_feature_4_title' => 'Feature 4',
                'wcu_feature_4_description' => 'Description of Feature 4',
                'wh_title' => 'Our Team',
                'wh_description' => 'Meet the talented individuals behind our success.',
                'wh_feature_1' => 'Team Member 1',
                'wh_feature_2' => 'Team Member 2',
                'wh_feature_3' => 'Team Member 3',
                'wh_feature_4' => 'Team Member 4',
            ]);
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
