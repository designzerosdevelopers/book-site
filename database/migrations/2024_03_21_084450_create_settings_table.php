<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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
                $table->string('note')->nullable(true);
                $table->timestamps();
            });


            $settings = [
                'STRIPE_SECRET' => ['Stripe secret', 'Secret key used for Stripe API authentication'],
                'PAYPAL_KEY' => ['Paypal key', 'API key used for PayPal payments'],
                'PAYPAL_SECRET' => ['Paypal secret', 'Secret key used for PayPal API authentication'],
                'MAIL_MAILER' => ['Mail mailer', 'Driver to be used for sending emails (e.g., smtp)'],
                'MAIL_HOST' => ['Mail host', 'SMTP server host address (e.g., smtp.example.com)'],
                'MAIL_PORT' => ['Mail port', '587 for TLS, 465 for SSL, 25 for standard SMTP without encryption'],
                'MAIL_USERNAME' => ['Mail username', 'Username for authenticating with the mail server'],
                'MAIL_APP_PASSWORD' => ['Mail app password', 'Password for authenticating with the mail server'],
                'MAIL_ENCRYPTION' => ['Mail encryption', 'Encryption protocol to be used. Example: tls or ssl'],
                'MAIL_FROM_ADDRESS' => ['Mail from address', 'Email address used as the "From" address in outgoing emails'],
                'MAIL_FROM_NAME' => ['Mail from name', 'Name used as the "From" name in outgoing emails'],
                'AWS_ACCESS_KEY_ID' => ['AWS Access Key ID', 'Access key ID for AWS services'],
                'AWS_SECRET_ACCESS_KEY' => ['AWS Secret Access Key', 'Secret access key for AWS services'],
                'AWS_REGION' => ['AWS Region', 'Region where your AWS resources are located (e.g., us-east-1)'],
                'AWS_BUCKET' => ['AWS Bucket', 'Name of the AWS S3 bucket for storing files']
            ];
            

            // Create an array to hold the data for bulk insertion
            $data = [];

            foreach ($settings as $key => $values) {
                $data[] = [
                    'key' => $key,
                    'display_name' => $values[0], // Display name
                    'note' => $values[1], // Note
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
