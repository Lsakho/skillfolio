<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = Job::factory()->count(10)->create();
    }
}
