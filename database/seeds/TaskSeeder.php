<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

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
        $users = DB::table('users')->select()->get();
        $statuses = ['assigned', 'inprogress', 'done'];

        foreach($users as $user) {
            for($t = 0; $t < 10; $t++) {
                $tasks[] = [
                    'user_id' => $user->id,
                    'name' => $faker->company,
                    'description' => $faker->sentence,
                    'status' => $statuses[array_rand($statuses)],
                    'created_at' => Carbon::now()->subMinutes(rand(500, 100000)),
                    'updated_at' => Carbon::now()->subMinutes(rand(500, 100000))
                ];
            }
        }

        DB::table('tasks')->insert($tasks);
    }
}
