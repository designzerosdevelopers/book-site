<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Settings;

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

            $valuekey = Settings::find(3);
            $valuekey->value = 'AZpUqpvG8mms_t-YZiPnA6N0CR3ik8J8Wpl6eCSQIL70WtchCer8JWNIIs17u8exjG1Y1qES3twWsV7r';
            $valuekey->save();

            $valuesecret = Settings::find(4);
            $valuesecret->value = 'EN3weUICqmd_XWb1oH2T_mj3tM9CtTofCVxVmefVt5UoqyXo4__q7jC7UmQgMcvrfJ63AAPvF-xHQnvP';
            $valuesecret->save();
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
