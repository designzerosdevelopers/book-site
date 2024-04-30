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
        if (!Schema::hasTable('about')) {
            Schema::create('about', function (Blueprint $table) {
                $table->id();
                $table->string('about_hs_title')->nullable();
                $table->text('about_hs_description')->nullable();
                $table->string('about_hs_image')->nullable();
                $table->string('button_1_name')->nullable();
                $table->string('button_1_url')->nullable();
                $table->string('button_2_name')->nullable();
                $table->string('button_2_url')->nullable();
                $table->timestamps();
            });
            DB::table('about')->insert([
                'about_hs_title' => 'About Us',
                'about_hs_description' => 'DigitalStore is dedicated to providing readers with access to a vast and diverse collection of digital books. Our mission is to inspire a love for reading and make great literature accessible to everyone, everywhere. With a commitment to quality and innovation, we strive to create an exceptional reading experience for our customers.',
                'about_hs_image' => 'about_us_image.jpg',
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
        Schema::dropIfExists('about');
    }
};
