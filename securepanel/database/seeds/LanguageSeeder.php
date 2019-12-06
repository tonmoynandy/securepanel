<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'code' => 'EN',
            'name' => 'English'
        ]);
        DB::table('languages')->insert([
            'code' => 'AR',
            'name' => 'Arabic'
        ]);

    }
}
