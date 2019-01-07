<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            ['short_name' => 'cse', 'name' => 'Computer Science And Engineering'],
            ['short_name' => 'ece', 'name' => 'Electronics And Communication Engineering'],
            ['short_name' => 'me', 'name' => 'Mechanical Engineering'],
            ['short_name' => 'eee', 'name' => 'Electrical And Electronics Engineering'],
            ['short_name' => 'civil', 'name' => 'Civil Engineering'],
            ['short_name' => 'cultural', 'name' => 'Cultural'],
            ['short_name' => 'robotics', 'name' => 'Robotics'],
            
        ]);
    }
}