<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navbar extends Model
{
    protected $table = 'navbar'; // Specify the correct table name

    protected $fillable = ['name', 'position'];
}




