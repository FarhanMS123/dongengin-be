<?php

namespace Database\Factories;

use App\Models\Preference;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cards_length = rand(0, 7);
        $cards = collect([]);

        $faker = \Faker\Factory::create();

        for($i=0; $i<=$cards_length; $i++){
            $cards->push($faker->unique()->numberBetween(0, 7));
        }

        $poins = rand(0, 1000);
        return [
            'fullname' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'birthdate' => now(),
            'password' => Hash::make('TestPass123!'),
            'poins' => $poins,
            'coins' => rand(0, $poins),
            'cards' => $cards->toJson(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    // public function configure()
    // {
    //     return $this->afterMaking(function (User $user) {
    //         PreferenceFactory::new()->count(5)->make([
    //             'user_id' => $user->id
    //         ]);
    //     })->afterCreating(function (User $user) {
    //         //
    //     });
    // }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
