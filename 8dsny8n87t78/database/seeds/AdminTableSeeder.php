<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('12345'),
        ]);
    }
}
