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
        if (!Schema::hasTable('items')) {
            Schema::create('items', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 8, 2);
                $table->string('slug');
                $table->string('image');
                $table->string('file');
                $table->text('description');
                $table->bigInteger('category');
                $table->timestamps();
            });
            DB::table('items')->insert([
              ['name' => 'Alchemsit',
               'price' => '55.00',
               'slug' => 'alchemist',
               'image' => 'alchemist.jpg',
               'file' => '69a8cabb-9c12-402f-bad4-08989f79af73.pdf',
               'description' => "'The Alchemist' is a timeless novel by Brazilian author Paulo Coelho, originally published in Portuguese in 1988. It tells the story of Santiago, a shepherd boy who embarks on a journey to discover his Personal Legend, a term Coelho uses to describe ones purpose or destiny in life. Along the way, Santiago encounters various obstacles and learns important lessons about following one's dreams, listening to one's heart, and understanding the language of the universe. Filled with spiritual wisdom and allegorical elements, 'The Alchemist' has become a beloved classic, inspiring readers around the world to pursue their dreams and embrace the journey of self-discovery.",
               'category' => '1',
            ],
                ['name' => 'Art of war',
                'price' => '40.50',
                'slug' => 'art-of-war',
                'image' => '65f69c18da56b.png',
                'file' => '69a8cabb-9c12-402f-bad4-08989f79af73.pdf',
                'description' => "'The Art of War' is an ancient Chinese military treatise attributed to Sun Tzu, a military strategist and philosopher. It's a timeless masterpiece on strategy and tactics, delving into the nuances of warfare, leadership, and conflict resolution. Divided into thirteen chapters, it covers topics ranging from the importance of knowing oneself and one's enemy to the use of deception, positioning, and adaptability on the battlefield. While primarily written for military purposes, its principles have been widely applied in various fields, including business, politics, and sports, making it a classic text on the art of strategy and achieving victory.",
                'category' => '5',
            ],
            ]);
        }
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
