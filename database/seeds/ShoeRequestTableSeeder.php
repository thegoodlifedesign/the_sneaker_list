<?php

class ShoeRequestTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('shoe_requests')->truncate();

        for($i = 0; $i < 500; $i++)
        {
            $status = rand(1,4);

            if($status === 1)
            {
                $price = null;
            }
            else
            {
                $price = $faker->randomDigitNotNull;
            }

            DB::table('shoe_requests')->insert([
                'shoe_request_number' => rand(10000000,99999999),
                'member_id' => rand(1,50),
                'status_id' => $status,
                'size' => rand(6,15),
                'brand' => $faker->firstName,
                'model' => $faker->firstName,
                'message' => $faker->text(),
                'price' => $price
            ]);
        }
    }
}