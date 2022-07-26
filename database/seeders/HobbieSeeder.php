<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hobbie;


class HobbieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hobbies = Hobbie::factory()->count(5)->create();

    }
}
