<?php

use Illuminate\Database\Seeder;
use App\Models\CalculationType;

class CalculationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesJson = file_get_contents('./database/seeds/strings/calculationtype.json');
        $typesArray = json_decode($typesJson, true);

        foreach($typesArray as $type)
        {
            CalculationType::create($type);
        }
    }
}
