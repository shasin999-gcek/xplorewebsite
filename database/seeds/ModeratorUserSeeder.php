<?php

  use Illuminate\Database\Seeder;

  class ModeratorUserSeeder extends Seeder
  {
      public function run()
      {
          factory(\App\User::class, 1)->create([
              'name' => 'Moderator',
              'email' => 'moderator@xplore19.in',
              'mobile_number' => '1111111111',
              'referred_by' => 'NO_REFERER_FOR_MODERATOR',
              'firebase_uid' => 'NO_FIREBASE_UID_FOR_MODERATOR',
              'is_admin' => true
          ]);

      }
  }