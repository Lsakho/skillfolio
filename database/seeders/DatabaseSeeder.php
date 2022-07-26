<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Training;
use App\Models\Enterprise;
use App\Models\Job;
use App\Models\Hobbie;
use App\Models\Skill;
use App\Models\ProfileSkill;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            ProfileSeeder::class,
            SkillSeeder::class,
            TrainingSeeder::class,
            SessionSeeder::class,
            HobbieSeeder::class,
            RatingSeeder::class,
            ProfileHobbieSeeder::class,
            EnterpriseSeeder::class,
            JobSeeder::class,
            ProfileSkillSeeder::class,
            JobSkillSeeder::class,


        ]);



    }
}
