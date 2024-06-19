<?php

namespace Database\Seeders;

use App\Models\Dataset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatasetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dataset::create([
            'url' => 'https://bucket-dataset-science.s3.amazonaws.com/datasets/2023_07_11_00_35_34.csv',
            'carpeta' => 'datasets/2023_07_11_00_35_34.csv',
            'filename' => '2023_07_11_00_35_34.csv',
            'forecastArn' => 'arn:aws:forecast:us-east-1:630886284847:forecast/forecast'
        ]);
    }
}
