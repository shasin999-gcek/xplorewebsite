<?php

use Illuminate\Database\Seeder;

class CollegeListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\CollegeList::class, 50)->create();
    }
}
