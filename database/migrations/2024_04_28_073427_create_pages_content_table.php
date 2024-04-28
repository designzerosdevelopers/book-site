<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\Page_Content_Seeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('page_content')) {
            Schema::create('pages_content', function (Blueprint $table) {
                $table->id();
                $table->string('hero_heading')->nullable();
                $table->text('hero_paragraph')->nullable();
                $table->string('hero_image')->nullable();
                $table->string('home_wcu_image')->nullable();
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
                $table->string('about_hs_image')->nullable();
                $table->string('contact_hs_title')->nullable();
                $table->string('contact_hs_description')->nullable();
                $table->string('contact_hs_image')->nullable();
                $table->timestamps();
            });
            DB::table('pages_content')->insert([
                'hero_heading' => 'Dummy Hero Heading',
                'hero_paragraph' => 'Dummy Hero Paragraph',
                'hero_image' => 'hero_image.png',
                'home_wcu_image' => 'down1.png',
                'ps_title' => 'Dummy PS Title',
                'ps_description' => 'Dummy PS Description',
                'wcu_title' => 'Dummy WCU Title',
                'wcu_description' => 'Dummy WCU Description',
                'wcu_feature_1_title' => 'Dummy WCU Feature 1 Title',
                'wcu_feature_1_description' => 'Dummy WCU Feature 1 Description',
                'wcu_feature_2_title' => 'Dummy WCU Feature 2 Title',
                'wcu_feature_2_description' => 'Dummy WCU Feature 2 Description',
                'wcu_feature_3_title' => 'Dummy WCU Feature 3 Title',
                'wcu_feature_3_description' => 'Dummy WCU Feature 3 Description',
                'wcu_feature_4_title' => 'Dummy WCU Feature 4 Title',
                'wcu_feature_4_description' => 'Dummy WCU Feature 4 Description',
                'wh_title' => 'Dummy WH Title',
                'wh_description' => 'Dummy WH Description',
                'wh_feature_1' => 'Dummy WH Feature 1',
                'wh_feature_2' => 'Dummy WH Feature 2',
                'wh_feature_3' => 'Dummy WH Feature 3',
                'wh_feature_4' => 'Dummy WH Feature 4',
                'about_hs_title' => 'Dummy About HS Title',
                'about_hs_description' => 'Dummy About HS Description',
                'about_hs_image' => 'dummy_about_hs_image.jpg',
                'contact_hs_title' => 'Dummy Contact HS Title',
                'contact_hs_description' => 'Dummy Contact HS Description',
                'contact_hs_image' => 'dummy_contact_hs_image.jpg',
            ]);

        }
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages_content');
    }
};
