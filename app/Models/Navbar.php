<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $table = 'navbar'; 

    protected $fillable = ['name', 'position'];
}




