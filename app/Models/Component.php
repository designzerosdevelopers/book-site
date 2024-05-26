<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fullhtml',
        'herohtml',
        'middlehtml',
        'lowerhtml',
        'css',
        'data',
    ];
}
