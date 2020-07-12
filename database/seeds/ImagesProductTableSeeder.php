<?php

use Illuminate\Database\Seeder;
use App\Models\ImageProduct;

class ImagesProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ImageProduct::class, 10)->create();
    }
}
