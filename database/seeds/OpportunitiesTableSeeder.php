<?php

use Illuminate\Database\Seeder;

class OpportunitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::table('opportunities')->delete();

        $faker = Faker\Factory::create();
        $limit = 99;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('opportunities')->insert([
                #'id' => Uuid::generate(),
                'host_id' => $faker->unique()->numberBetween(1, 99),
                'status' => 'In Catalog',
                'title' => $faker->sentence(3, true),
                'country' => $faker->country,
                'discipline' => $faker->randomElement(['Computer & Information Science and Engineering , Engineering, Mathematics' ,'Biological Sciences', 'Engineering', 'Physics & Astronomy']),
                'duration' => $faker->randomElement(['2-6 months' ,'6-12 months']),
                'num_positions' => $faker->randomElement(['1' ,'2', '3 or more']),
                'work_environment' => $faker->paragraph(3, true),
                'project_description' => $faker->paragraph(3, true),
                'benefits' => $faker->paragraph(3, true),
                'expected_outcomes' => $faker->paragraph(3, true),
                'project_summary' => $faker->paragraph(3, true),
                'is_filled' => $faker->boolean(10),
                'submitted_at' => $faker->dateTime(),
                'deleted_at' => null,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
            ]);
        }
    }
}
