<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Profile;
use App\Models\Training;
use App\Models\Session;



class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        $profiles = Profile::all();
        $trainings = Training::all()
                    ->each(function ($training) use ($profiles) {

                        $idProfile = $profiles->random()->id;
                        $training->profileTraining()->attach([$idProfile]);

                    });




    //     $profiles = Profile::paginate(10);
    //     $trainings = Training::paginate(10);

    // foreach ($profiles as $training) {
    //     foreach ($trainings as $profile) {

    //         Session::firstOrCreate([

    //             'profile_id' => $profile->id,
    //             'training_id' => $training->id,
    //             'date' => rand(2017, 2022)

    //         ]);
    //     }

    // };
    }
}
