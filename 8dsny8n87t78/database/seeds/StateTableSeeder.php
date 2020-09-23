<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
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
            'country_id' => '1',
            'state' => 'Tamil Nadu',
        ]);
    }
}
