<?php
use App\Models\Categories;
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
        if (!Schema::hasTable('categories')) {

            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('category_name');
                $table->timestamps();
            });
            DB::table('categories')->insert([
                ['category_name' => 'Fiction'], 
                ['category_name' => 'Story'],
                ['category_name' => 'Finance'],
                ['category_name' => 'Mystery and thriller'],
                ['category_name' => 'warfare']
            ]);
            
        }
    }



     



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
