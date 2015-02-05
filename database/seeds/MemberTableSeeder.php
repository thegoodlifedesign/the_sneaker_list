<?php

use Illuminate\Support\Facades\Hash;

class MemberTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('members')->truncate();

        DB::table('members')->insert([
            'username' => 'rodzzlessa',
            'slug' => 'rodzzlessa',
            'email' => 'rodrigo@tgld.co',
            'full_name' => 'rodrigo lessa',
            'password' => Hash::make('ro'),
            'is_admin' => 1
        ]);

        for($i = 0; $i < 50; $i++)
        {
            $username = $faker->userName;

            DB::table('members')->insert([
                'username' => $username,
                'slug' => $this->slugify($username),
                'email' => $faker->email,
                'full_name' => $faker->name,
                'password' => Hash::make('test'),
            ]);
        }
    }
}