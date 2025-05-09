<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $startDate = Carbon::createFromTimeStamp(fake()->dateTimeBetween('-30 days', '+30 days')->getTimestamp());
        $endDate = $startDate->copy()->addMonth();

        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'room_id' => Room::factory(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'note' => fake()->text(),
            'price' => fake()->numberBetween(200, 500),
        ];
    }
}
