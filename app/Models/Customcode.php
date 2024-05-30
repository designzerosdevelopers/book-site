<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customcode extends Model
{
    use HasFactory;
    protected $table = 'customcode'; 
    protected $fillable = ['link','type'];
}
