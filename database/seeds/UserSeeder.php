<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Add initial admin user
        $users = [
            [
                'name' => 'Aivaras',
                'email' => 'stasiulis.aivaras@gmail.com',
                'password' => bcrypt('admin'),
                'admin' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        // Add random users
        for($i = 0; $i < 10; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('userpass'),
                'admin' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('users')->insert($users);
    }
}
