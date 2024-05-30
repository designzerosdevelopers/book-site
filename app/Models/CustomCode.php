<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomCode extends Model
{
    use HasFactory;
   Protected $table = "custom_code";
   Protected $fillable =['for','type', 'file', 'link'];

}
