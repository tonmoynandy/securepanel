<?php

use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->insert([
            'param_name' => 'facebook_link',
            'param_value' => 'www.facebook.com',
            'type' => 'TEXT'
        ]);
        DB::table('site_settings')->insert([
            'param_name' => 'twitter_link',
            'param_value' => 'www.twitter.com',
            'type' => 'TEXT'
        ]);
        DB::table('site_settings')->insert([
            'param_name' => 'linkedin_link',
            'param_value' => 'www.linked.com',
            'type' => 'TEXT'
        ]);
        DB::table('site_settings')->insert([
            'param_name' => 'from_email',
            'param_value' => 'test@mailinator.com',
            'type' => 'TEXT'
        ]);
        DB::table('site_settings')->insert([
            'param_name' => 'default_meta_name',
            'param_value' => 'Numou',
            'type' => 'TEXT'
        ]);
        DB::table('site_settings')->insert([
            'param_name' => 'default_meta_description',
            'param_value' => 'Numou',
            'type' => 'TEXT'
        ]);
    }
}
