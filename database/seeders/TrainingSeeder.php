<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\Profile;
use App\Models\Enterprise;
use App\Models\Session;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $trainings = Training::factory()->count(10)->create();

    }
}
