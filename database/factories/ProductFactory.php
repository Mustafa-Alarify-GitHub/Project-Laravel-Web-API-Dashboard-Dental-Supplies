<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'image' => $this->faker->randomElement([
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREO1z0C0vOg0mBi15kaTawARsJjUP6KL1zkg&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBLapFPWlwLc09uotWon4eXuQpWP4e7hkIew&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLFRancb2s3_SW9c8Jyc4SkLJ7dFijWJhxow&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT2lWevdMNLF_850wQRurGM9JIc4tefT-v_Yw&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8-TnDaV1CfzG1VkhZIRsml8J47vel2O4FBQ&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSftzW6gWCMg_WGrh7GNnB9c4ZHEiiACxh36A&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8kpOy7a8EBLZsqRnokluZ_lLZXUxRoAvLoQ&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjY-DaQ9jZvGEtbFV_gIRj_92cutADniDGYw&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRsTF_8G10SXX26hKGU96TI0iDm6FLSs--qSg&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhhr--7gE8Qf1rosPrDMfiWGj7Rx_Kh9Z3_A&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE1keFGro80_zjw3p-zeYIYYMIm7GW6MrKng&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRlPaCxlf5_G3kbDl_a2AX_Z7U82Al8D6vfdA&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5MuqIysu0hL7rXmP7MSCUqUqBbcLPqsiX8g&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6pqKzKWLdw3g2uXogyCH0TVMYINOqxnHRgw&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTUUwsYLF2SuBaDGWNeZh_fXKS1P11HGrqUA&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqKQp5IOQxxrHEqHdiSmTlVEkTpFIzBWXAyX1lO4Dl-aS32iNYy-GG6HUPxwVRgg3r2es&usqp=CAU",
            ]),
            'modeType' => $this->faker->randomElement(['Type A', 'Type B', 'Type C']),
            'description' => $this->faker->paragraph,
            'price_buy' => $this->faker->randomFloat(2, 10, 100),
            'price_sales' => $this->faker->randomFloat(2, 20, 200),
            'counter' => $this->faker->numberBetween(1, 100),
            'Manger_Id' => User::inRandomOrder()->where("type", "Admin Provider")->first()->id,
        ];
    }
}
