<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Navbar;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('navbar', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->integer('position');
            $table->timestamps();
        });

        $manu = [
            [
                'name' => 'Home',
                'route' => 'index',
                'position' => 1,
            ],
            [
                'name' => 'Shop',
                'route' => 'shop',
                'position' => 2,
            ],
            [
                'name' => 'About Us',
                'route' => 'about',
                'position' => 3,
            ],
            [
                'name' => 'Blog',
                'route' => 'blog',
                'position' => 4,
            ],
            [
                'name' => 'Contact',
                'route' => 'contact',
                'position' => 5,
            ],
        ];

        foreach ($manu as $item) {
            $menu = new Navbar();
            $menu->name = $item['name'];
            $menu->route = $item['route'];
            $menu->position = $item['position'];
            $menu->save();
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navbar');
    }
};
