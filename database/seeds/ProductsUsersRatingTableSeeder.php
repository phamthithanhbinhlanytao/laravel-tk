<?php

use Illuminate\Database\Seeder;
use App\Models\ProductUserRating;

class ProductsUsersRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductUserRating::class, 10)->create();
    }
}
