<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {

            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key');
                $table->string('display_name');
                $table->string('value')->nullable(true);
                $table->timestamps();
            });



            // Retrieve keys and display names
            $stripeKeys = [
                'STRIPE_KEY' => 'Stripe key',
                'STRIPE_SECRET' => 'Stripe secret',
                'PAYPAL_KEY' => 'Paypal key',
                'PAYPAL_SECRET' => 'Paypal secret',
                'MAIL_MAILER' => 'Mail mailer',
                'MAIL_HOST' => 'Mail host',
                'MAIL_PORT' => 'Mail port',
                'MAIL_USERNAME' => 'Mail username',
                'MAIL_PASSWORD' => 'Mail password',
                'MAIL_ENCRYPTION' => 'Mail encryption',
                'MAIL_FROM_ADDRESS' => 'Mail from address',
                'MAIL_FROM_NAME' => 'Mail from name'
            ];

            // Create an array to hold the data for bulk insertion
            $data = [];

            // Loop through the keys array
            foreach ($stripeKeys as $key => $display) {
                $data[] = [
                    'key' => $key,
                    'display_name' => $display,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert records directly into the settings table
            DB::table('settings')->insert($data);
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
