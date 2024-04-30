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
        if (!Schema::hasTable('home')) {
            Schema::create('home', function (Blueprint $table) {
                $table->id();
                $table->string('hero_heading')->nullable();
                $table->text('hero_paragraph')->nullable();
                $table->string('hero_image')->nullable();
                $table->string('home_wcu_image')->nullable();
                $table->string('ps_title')->nullable();
                $table->text('ps_description')->nullable();
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
                $table->string('button_1_name')->nullable();
                $table->string('button_1_url')->nullable();
                $table->string('button_2_name')->nullable();
                $table->string('button_2_url')->nullable();
                $table->timestamps();
            });
            DB::table('home')->insert([
                'hero_heading' => 'Welcome to DigitalStore',
                'hero_paragraph' => 'Discover a vast collection of digital books for every reader. Whether you enjoy diving into thrilling mysteries, exploring fantastical worlds, or delving into thought-provoking non-fiction, DigitalStore has something for you.',
                'hero_image' => 'hero_image.png',
                'home_wcu_image' => 'down1.png',
                'ps_title' => 'Our Products',
                'ps_description' => 'Discover an extensive array of digital books meticulously curated to align with your unique reading preferences. Immerse yourself in a world of literary wonders, from riveting best-selling novels that transport you to distant realms of imagination, to comprehensive educational textbooks that empower you with knowledge. Our diverse selection caters to the nuanced tastes and interests of every reader, ensuring a fulfilling reading experience tailored to your individual needs.',

                'wcu_title' => 'Why Choose Us?',
                'wcu_description' => 'At DigitalStore, we are committed to providing an exceptional reading experience. Discover why readers trust us for their literary needs and why we stand out among the competition.',
                'wcu_feature_1_title' => 'Wide Selection',
                'wcu_feature_1_description' => 'Explore thousands of titles across various genres, ensuring there\'s something for every taste and interest.',
                'wcu_feature_2_title' => 'Instant Access',
                'wcu_feature_2_description' => 'Gain instant access to your purchased books from any device, allowing you to start reading wherever you are without delay or inconvenience.',
                'wcu_feature_3_title' => 'Affordable Prices',
                'wcu_feature_3_description' => 'Enjoy affordable prices for high-quality digital books, making it easier than ever to indulge in your love of reading.',
                'wcu_feature_4_title' => 'User-Friendly Experience',
                'wcu_feature_4_description' => 'Navigate our platform with ease and find your next favorite read quickly with our intuitive interface and robust search features.',
                'wh_title' => 'We\'re Here to Help',
                 'wh_description' => 'Meet the dedicated team committed to ensuring your experience with DigitalStore is nothing short of excellent. From assistance with purchases to resolving any issues, we\'re here to support you every step of the way. Discover the benefits of choosing DigitalStore for all your digital book needs. From an extensive library to convenient access options, we offer everything you need for an enjoyable reading experience.',
                'wh_feature_1' => 'John Doe - CEO',
                'wh_feature_2' => 'Jane Smith ',
                'wh_feature_3' => 'David Johnson - Content Curator',
                'wh_feature_4' => 'Emily Brown - Marketing Manager',
                'button_1_name' => 'Read More',
                'button_1_url' => '#',
                'button_2_name' => 'Contact Us',
                'button_2_url' => '#',


            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home');
    }
};
