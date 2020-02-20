<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Delivery_timesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        DB::table('delivery_times')->insert([
            [
                'delivery_at' => '9->12',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'delivery_at' => '14->18',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'delivery_at' => '10->13',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'delivery_at' => '15->19',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'delivery_at' => '9->13',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'delivery_at' => '18->20',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}