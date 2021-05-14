<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsJson = file_get_contents('./database/seeds/strings/products.json');
        $productsArray = json_decode($productsJson, true);

        foreach($productsArray as $product)
        {
            // Product::create($product);
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'photo' => $product['photo'],
                'price' => $product['price'],
                'product_type_id' => $product['product_type_id'],
                'attributes' => json_encode($product['attributes'])
            ]);
        }
    }
}
