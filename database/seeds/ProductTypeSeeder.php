<?php

use Illuminate\Database\Seeder;
use App\Models\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productTypesJson = file_get_contents('./database/seeds/strings/producttype.json');
        $productTypesArray = json_decode($productTypesJson, true);

        foreach($productTypesArray as $type)
        {
            ProductType::create($type);
        }
    }
}
