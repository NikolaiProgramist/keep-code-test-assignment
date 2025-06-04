<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            "full_price" => "2800000.0000",
            "rental_price" => "1300.0000",
            "name" => "X2",
            "brand" => "BMV",
            "color" => "silver",
            "transmission" => "automatic",
            "fuel" => "petrol",
            "power" => 80,
            "PIN" => 111111111111
        ]);

        DB::table('cars')->insert([
            "full_price" => "1800000.0000",
            "rental_price" => "1100.0000",
            "name" => "X2",
            "brand" => "BMV",
            "color" => "black",
            "transmission" => "automatic",
            "fuel" => "petrol",
            "power" => 70,
            "PIN" => 222222222222
        ]);



        DB::table('cars')->insert([
            "full_price" => "4800000.0000",
            "rental_price" => "1600.0000",
            "name" => "Seal",
            "brand" => "BYD",
            "color" => "white",
            "transmission" => "automatic",
            "fuel" => "electric",
            "power" => 68,
            "PIN" => 333333333333
        ]);
    }
}
