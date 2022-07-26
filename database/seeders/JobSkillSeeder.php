<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\Skill;


class JobSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = Job::all();
        $skills = Skill::all()
                ->each(function ($skill) use ($jobs) {

                    $idJobs = $jobs->random()->id;
                    $skill->jobskill()->attach([$idJobs]);

                });
    }
}
