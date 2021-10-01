<?php

namespace Database\Seeders;

use App\Models\Preference;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = \Faker\Factory::create();

        for($i=0; $i<20; $i++){
            $this->makeUser();
        }


        // UserFactory::new()->count(20)->make();
    }

    public function makeUser(){
        $cards_length = rand(0, 7);
        $cards = collect([]);

        $faker = \Faker\Factory::create();

        for($i=0; $i<=$cards_length; $i++){
            $cards->push($faker->unique()->numberBetween(0, 7));
        }

        $poins = rand(0, 1000);
        $u = User::create([
            'fullname' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'birthdate' => now(),
            'password' => Hash::make('TestPass123!'),
            'poins' => $poins,
            'coins' => rand(0, $poins),
            'cards' => $cards->toJson(),
            'remember_token' => Str ::random(10),
        ]);

        $faker = \Faker\Factory::create();

        for($i=0; $i<5; $i++){
            $this->makePreference($u->id, $faker);
        }
    }

    public function makePreference($user_id, $faker){
        $rate = rand(0, 5);
        $page = rand(0, 5);
        Preference::create([
            'user_id' => $user_id,
            'status' => ($page == 0 ? null : ($page == 5 ? "finish" : ('page_' . $page))),
            'is_favorite' => rand(0, 1),
            // 'category',
            'rate' => ($rate == 0 ? null : $rate),
            // 'story_id' => $this->faker->unique()->numberBetween(1, 9)
            // 'story_id' => $this->faker->numberBetween(1, 9)
            'story_id' => $faker->unique()->numberBetween(1, 8)
        ]);
    }
}
