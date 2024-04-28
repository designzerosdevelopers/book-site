<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    protected $table = "pages_content";
    protected $fillable = [
        'hero_heading',
        'hero_paragraph',
        'hero_image',
        'ps_title',
        'ps_description',
        'wcu_title',
        'wcu_description',
        'wcu_feature_1_title',
        'wcu_feature_1_description',
        'wcu_feature_2_title',
        'wcu_feature_2_description',
        'wcu_feature_3_title',
        'wcu_feature_3_description',
        'wcu_feature_4_title',
        'wcu_feature_4_description',
        'wh_title',
        'wh_description',
        'wh_feature_1',
        'wh_feature_2',
        'wh_feature_3',
        'wh_feature_4',
        'about_hs_title',
        'about_hs_description',
        'contact_hs_title',
        'contact_hs_description',
    ];
}
