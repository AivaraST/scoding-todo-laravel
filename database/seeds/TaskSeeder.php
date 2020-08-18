<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $tasks = [];

        for($t = 0; $t < 5; $t++) {
            $tasks[] = [
                'user_id' => 1,
                'name' => $faker->company,
                'description' => $faker->sentence,
                'status' => 'assigned',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        for($t = 0; $t < 3; $t++) {
            $tasks[] = [
                'user_id' => 1,
                'name' => $faker->word,
                'description' => $faker->sentence,
                'status' => 'inprogress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        for($t = 0; $t < 10; $t++) {
            $tasks[] = [
                'user_id' => 1,
                'name' => $faker->word,
                'description' => $faker->sentence,
                'status' => 'done',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('tasks')->insert($tasks);
    }
}
