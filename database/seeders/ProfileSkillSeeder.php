<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\ProfileSkill;



class ProfileSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $skills = Skill::all();
        $profile = Profile::all()
                    ->each(function ($profile) use ($skills) {

                        $idSkill = $skills->random()->id;
                        $profile->profileskill()->attach([$idSkill]);
                    });


    }
}
