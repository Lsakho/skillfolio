<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $profiles = Profile::all();
        $skills = Skill::all()
                    ->each(function ($skill) use ($profiles) {

                        $idProfile = $profiles->random()->id;
                        $skill->profiles()->attach([$idProfile]);

                    });

        
          

    }
}
