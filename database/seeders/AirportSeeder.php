<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Airport;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airport::truncate();
        $heading = true;
        $input_file = fopen(base_path("database\data\airport-codes_csv.csv"), "r");
        while (($record = fgetcsv($input_file, 1000, ",")) !== FALSE)
        {
            if (!$heading)
            {
                $product = array(
                    "ident" => $record['0'] ,
                    "type" => $record['1'],
                    "name" => $record['2'],
                    "elevation_ft" => $record['3'],
                    "continent" => $record['4'],
                    "iso_country" => $record['5'],
                    "iso_region" => $record['6'],
                    "municipality" => $record['7'],
                    "gps_code" => $record['8'],
                    "iata_code" => $record['9'],
                    "local_code" => $record['10'],
                    "coordinates" => $record['11'],
                );
                Airport::create($product);    
            }
            $heading = false;
        }
        fclose($input_file);
    }
}
