<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@numou.com',
            'password' => bcrypt('Numou@9102')
        ]);
    }
}
