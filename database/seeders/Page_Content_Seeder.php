<?php

namespace Database\Seeders;
use App\Models\Pages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Page_Content_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages_content')->insert([
            'hero_heading' => 'Dummy Hero Heading',
            'hero_paragraph' => 'Dummy Hero Paragraph',
            'hero_image' => 'dummy_hero_image.jpg',
            'ps_title' => 'Dummy PS Title',
            'ps_description' => 'Dummy PS Description',
            'wcu_title' => 'Dummy WCU Title',
            'wcu_description' => 'Dummy WCU Description',
            'wcu_feature_1_title' => 'Dummy WCU Feature 1 Title',
            'wcu_feature_1_description' => 'Dummy WCU Feature 1 Description',
            'wcu_feature_2_title' => 'Dummy WCU Feature 2 Title',
            'wcu_feature_2_description' => 'Dummy WCU Feature 2 Description',
            'wcu_feature_3_title' => 'Dummy WCU Feature 3 Title',
            'wcu_feature_3_description' => 'Dummy WCU Feature 3 Description',
            'wcu_feature_4_title' => 'Dummy WCU Feature 4 Title',
            'wcu_feature_4_description' => 'Dummy WCU Feature 4 Description',
            'wh_title' => 'Dummy WH Title',
            'wh_description' => 'Dummy WH Description',
            'wh_feature_1' => 'Dummy WH Feature 1',
            'wh_feature_2' => 'Dummy WH Feature 2',
            'wh_feature_3' => 'Dummy WH Feature 3',
            'wh_feature_4' => 'Dummy WH Feature 4',
            'about_hs_title' => 'Dummy About HS Title',
            'about_hs_description' => 'Dummy About HS Description',
            'about_hs_image' => 'dummy_about_hs_image.jpg',
            'about_ps_image' => 'dummy_about_ps_image.jpg',
            'contact_hs_title' => 'Dummy Contact HS Title',
            'contact_hs_description' => 'Dummy Contact HS Description',
            'contact_hs_image' => 'dummy_contact_hs_image.jpg',
        ]);

    }
}
