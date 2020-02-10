<?php

use App\Models\Match;
use Illuminate\Database\Seeder;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = \Faker\Factory::create('id_ID');
        $status = ['waiting', 'ongoing', 'pending', 'finished', 'waiting'];
        for ($i = 0; $i <= 10; $i++) {
            $match = new Match();
            $match->player_one = $faker->name;
            $match->player_two = $faker->name;
            $match->field = $faker->streetName;
            $match->duration = '00:45:00';
            $match->arbitre = $faker->biasedNumberBetween($min = 2, $max = 12, $function = 'sqrt');
            $match->status = $status[random_int(0, 4)];
            $match->startTime = null;
            $match->endTime = null;
            $match->save();
        }
    }
}
