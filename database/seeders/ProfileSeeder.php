<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;


class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = Profile::factory()->count(10)->create();
    }
}
