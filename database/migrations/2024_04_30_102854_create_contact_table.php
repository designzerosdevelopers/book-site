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
        if (!Schema::hasTable('contact')) {
            Schema::create('contact', function (Blueprint $table) {
                $table->id();
                $table->string('contact_hs_title')->nullable();
                    $table->string('contact_hs_description')->nullable();
                    $table->string('contact_hs_image')->nullable();
                    $table->string('button_1_name')->nullable();
                    $table->string('button_1_url')->nullable();
                    $table->string('button_2_name')->nullable();
                    $table->string('button_2_url')->nullable();
                $table->timestamps();
            });
            DB::table('contact')->insert([
                'contact_hs_title' => 'Contact Us',
                'contact_hs_description' => 'We value your feedback and are here to assist you with any inquiries or concerns you may have. Feel free to reach out to us via email, phone, or our online contact form. Our dedicated support team is available to provide prompt and helpful assistance.',
                'contact_hs_image' => 'dummy_contact_hs_image.jpg',
                'button_1_name' => 'Contact Us',
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
        Schema::dropIfExists('contact');
    }
};
