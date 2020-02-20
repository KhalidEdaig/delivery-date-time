<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        DB::table('partners')->insert([
            [
                "name" => 'Mohamed',
                "city_id" => 2,
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                "name" => 'Hassan',
                "city_id" => 1,
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                "name" => 'Nada',
                "city_id" => 3,
                'created_at' => $now,
                'updated_at' => $now,

            ]
        ]);
    }
}