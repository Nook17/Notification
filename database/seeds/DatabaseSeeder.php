<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 /**
  * Seed the application's database.
  *
  * @return void
  */
 public function run()
 {
  $faker = Faker::create('pl_PL');

  $users = 20;
  $news  = 50;

  // ******************** USERS ****************************

  for ($user_id = 1; $user_id <= $users; $user_id++) {
   $created_data = $faker->dateTimeThisYear($max = 'now');
   if ($user_id == 1) {
    DB::table('users')->insert([
     'name'       => 'Arek Demko',
     'email'      => 'arek@o2.pl',
     'password'   => bcrypt('nook17'),
     'created_at' => $created_data,
    ]);
   }

   $gender = $faker->randomElement(['m', 'f']);

   if ($gender == 'm') {
    $name   = $faker->firstNameMale . ' ' . $faker->lastNameMale;
    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
   } elseif ($gender == 'f') {
    $name   = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
    $avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
   }

   DB::table('users')->insert([
    'name'       => $name,
    'email'      => str_replace('-', '', str_slug($name)) . '@' . $faker->freeEmailDomain,
    'password'   => bcrypt('nook17'),
    'created_at' => $created_data,
   ]);

   DB::table('settings')->insert([
    'user_id'       => $user_id,
    'notifi_follow' => 3,
    'notifi_news'   => 3,
    'created_at'    => $created_data,
   ]);
  }

  // ******************** NEWS ****************************

  for ($user_id = 1; $user_id <= $users; $user_id++) {
   DB::table('news')->insert([
    'user_id'    => $faker->numberBetween(1, $users),
    'message'    => $faker->paragraph($nbSenteces = 1, $variableNbSenteces = true),
    'created_at' => $faker->dateTimeThisYear($max = 'now'),
   ]);
  }
 }
}
