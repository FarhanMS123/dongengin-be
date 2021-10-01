<?php

namespace Database\Factories;

use App\Models\Preference;
use Illuminate\Database\Eloquent\Factories\Factory;

class PreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Preference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rate = rand(0, 5);
        $page = rand(0, 5);
        return [
            'user_id' => rand(0, 10),
            'status' => ($page == 0 ? null : ($page == 5 ? "finish" : ('page_' . $page))),
            'is_favorite' => rand(0, 1),
            // 'category',
            'rate' => ($rate == 0 ? null : $rate),
            // 'story_id' => $this->faker->unique()->numberBetween(1, 9)
            // 'story_id' => $this->faker->numberBetween(1, 9)
            'story_id' => rand(1,9)
        ];
    }
}
