<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enterprise;
use App\Models\Profile;


class EnterpriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = Profile::factory()->count(10)->create();
        $entreprises = Enterprise::factory()->count(10)->make()
                        ->each(function ($enterprise) use ($profiles){
                            $enterprise->profile_id = $profiles->random()->id;
                            $enterprise->save();
                        });
        
    }
}
