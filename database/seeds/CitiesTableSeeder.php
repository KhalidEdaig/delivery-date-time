<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        DB::table('cities')->insert([
            [
                'name' => 'Casa',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Rabat',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Tanger',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}