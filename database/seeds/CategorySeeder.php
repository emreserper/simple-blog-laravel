<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        $categories = ['Genel','House Stark', 'House Bolton', 'House Cerwyn', 'House Hornwood', 'House Karstark', 'House Mormont', 'House Tallhart', 'Flint of Widow’s Watch'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'image'=>$faker->imageUrl(800, 400, 'cats', true),
                'slug' => STR::slug($category),
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
