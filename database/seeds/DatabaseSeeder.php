<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminUserSeeder::class,
            CollegeListsTableSeeder::class,
            UserDetailsTableSeeder::class,
            EventCategoriesTableSeeder::class,
         //   EventsTableSeeder::class
        ]);
    }
}

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        factory(\App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'xplore19gcek@gmail.com',
            'is_admin' => true
        ]);

    }
}

class EventCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('event_categories')->insert([
            ['name' => 'Computer Science And Engineering'],
            ['name' => 'Electronics And Communication Engineering'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Electrical And Electronics Engineering'],
            ['name' => 'Civil Engineering'],
            ['name' => 'Cultural'],
            ['name' => 'Robotics']
        ]);
    }
}