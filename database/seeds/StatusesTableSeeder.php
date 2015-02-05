<?php

class StatusesTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('statuses')->truncate();

        $statuses = [
            'shoe request made',
            'price sent',
            'accepted',
            'declined',
        ];

        for($i = 0; $i < count($statuses); $i++)
        {
            DB::table('statuses')->insert([
                'name' => $statuses[$i],
                'slug' => $this->slugify($statuses[$i]),
            ]);
        }
    }
}