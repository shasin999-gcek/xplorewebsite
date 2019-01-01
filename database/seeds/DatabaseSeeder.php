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
            CategoriesTableSeeder::class,
        ]);
    }
}

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        factory(\App\User::class, 1)->create([
            'name' => 'Admin',
            'email' => 'xplore19gcek@gmail.com',
            'mobile_number' => '0000000000',
            'referred_by' => 'NO_REFERER_FOR_ADMIN',
            'firebase_uid' => 'NO_FIREBASE_UID_FOR_ADMIN',
            'is_admin' => true
        ]);

    }
}

