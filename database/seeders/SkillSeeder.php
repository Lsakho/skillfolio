<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use Faker\Factory as Faker;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Skill::create([
                'name' => $faker->word,
                'description'  => $faker->sentence,
            ]);
        }
    }
}
