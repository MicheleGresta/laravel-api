<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['FrontEnd', 'BackEnd', 'FullStack', 'Design', 'DevOps'];

        foreach ($types as $type){
            $new_type= new Type();
            $new_type->type = $type;

            $new_type->save();
        }
    }
}
