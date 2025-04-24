<?php

namespace Database\Factories;

use Arr;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Room;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => Arr::random([
                'Lisabon',
                'Ljubljana',
                'Paris',
                'Oslo',
                'Berlin',
                'Belgrade',
                'Skopje',
                'Tirana',
                'Atina',
                'Moskva',
                'Kiev',
                'Ankara',
                'Madrid',
                'Rome',
                'Vienna',
                'Prague',
                'Budapest',
                'Warsaw',
                'Zagreb',
                'Sarajevo',
            ]),
            'price' => $this->faker->numberBetween(100, 300),
            'image' => 'https://picsum.photos/400',
            'short_description' => fake()->text(),
            'long_description' => fake()->text(400),
        ];
    }
}
