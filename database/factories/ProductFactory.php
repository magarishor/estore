<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Facades\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $images = [];
        for($i = 1; $i <=4; $i++){

            $context = stream_context_create(array(
                'http' => array(
                    'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
                ),
            ));

            $img = Image::make(file_get_contents("http://picsum.photos/1280/720","", $context));



            $filename = "IMG" . date('YmdHis') . rand(1000, 9999) . ".jpg";

            $img->resize(1280, 720, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path("images/{$filename}"));

            $images[] = $filename;
        }
        return [
            'name' => fake()->name(),
            'details' => fake()->realTextBetween(2000, 5000),
            'summary' => fake()->realText(500),
            'price' => rand(500, 50000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'status' => 'Active',
            'images' => $images
        ];
    }
}
