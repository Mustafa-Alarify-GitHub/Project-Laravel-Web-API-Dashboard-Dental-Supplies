<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hero>
 */
class HeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                'image' => $this->faker->randomElement([
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI4Q5FQgSx--S2rKbu-p6IqhusLmyQR48ARw&s",
                    "https://www.shutterstock.com/image-vector/teeth-healthy-sparkling-white-looks-600nw-2048051147.jpg",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-JDFPMgAv_NMYgqDp5xRZMALozbHOlu_igQ&s",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZaCqIhsqk1jiI2kZzNfka28h5WvCESy9DoQ&s",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQF05e7BB8HVX1PNLLrEvSRxBo77H2KK0o99A&s",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTkBqqnWIwB5bP4jIwAl62WEdvgxAqamOBPRw&s",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTfKMhsErw_KTgLzORuY8B4vlLnecJrO8ZRw&s",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSr3e6l08Nib5Lap1dQlQbe4b4AVygffBEcqg&s",
                    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREh0JVudRRG5qvZ40oLx4XgGUsQy9xcC2Vfw&s",
                ]), 
                'end_time' => $this->faker->dateTimeBetween('now', '+1 year'), 
            ];
    }
}
