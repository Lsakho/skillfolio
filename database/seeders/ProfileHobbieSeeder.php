<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hobbie;
use App\Models\Profile;


class ProfileHobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hobbies = Hobbie::all();
        $profiles = Profile::all()
                ->each(function ($profile) use ($hobbies) {

                    $idHobbies = $hobbies->random()->id;
                    $profile->profiles_hobies()->attach([$idHobbies]);

                });
    }
}
