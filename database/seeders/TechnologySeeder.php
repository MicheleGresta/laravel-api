<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $technologies = ["Html","Scss","Vue","JavaScript","VueJS","Php","Laravel","MySQL","Java","Python","React","Angular"];
        
        foreach ($technologies as $technology) {
            Technology::create([
                'name'=> $technology,
                'color'=> $faker->colorName(),
                'description'=>$faker->text(100),
                'icon'=>""
            ]);
        }
    }
}
