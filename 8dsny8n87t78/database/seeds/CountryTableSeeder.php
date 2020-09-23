<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('country')->insert([
            'country' => 'India',
            'country_code' => '+91',
            'currency_code' => 'INR',
            'currency_symbol' => '₹',
        ]);
    }
}
