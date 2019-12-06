<?php

use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms')->insert([
            'title' => 'About Us',
            'slug' => 'about-us',
            'created_at' => date("Y-m-d H:m:s")
        ]);
        DB::table('translate_cms')->insert([
            'page_id' => '1',
            'lang_code' => 'EN',
            'title' => 'About Us',
            'description' =>'Test Cms',
            'meta_title' => 'About Us',
            'meta_description' => 'About Us'
        ]);
        DB::table('translate_cms')->insert([
            'page_id' => '1',
            'lang_code' => 'AR',
            'title' => 'About Us',
            'description' =>'Test Cms',
            'meta_title' => 'About Us',
            'meta_description' => 'About Us'
        ]);
    }
}
