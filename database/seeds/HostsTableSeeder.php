<?php

use Illuminate\Database\Seeder;

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('hosts')->delete();

        $faker = Faker\Factory::create();
        $limit = 99;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('hosts')->insert([
                #'id' => Uuid::generate(),
                'response_id' => $faker->unique()->randomNumber(4),
                'response_number' => $faker->unique()->randomNumber(4),
                'respondent_name' => $faker->name(),
                'respondent_email' => $faker->email(),
                'host_name' => $faker->sentence(3, true),
                'host_org_type' => $faker->randomElement(['Non-profit/Non-governmental Organization' ,'University', 'Research Center', '']),
                'host_support' => $faker->sentence(1, true),
                'host_website' => 'http://www.example.edu/' . $faker->unique()->slug,
                'deleted_at' => null,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }
    }
}
