<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = 'about';
    protected $fillable = [
        'button_1_name',
        'button_1_url',
        'button_2_name',
        'button_2_url',
    ];
}
