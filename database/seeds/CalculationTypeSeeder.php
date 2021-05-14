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
        $calculationTypesJson = file_get_contents('./database/seeds/strings/calculationtype.json');
        $calculationTypesArray = json_decode($calculationTypesJson, true);

        foreach($calculationTypesArray as $type)
        {
            CalculationType::create($type);
        }
    }
}
