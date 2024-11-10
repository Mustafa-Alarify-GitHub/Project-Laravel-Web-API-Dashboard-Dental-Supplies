<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), 
            'phone' => $this->faker->numerify('#########'), 
            'type' => $this->faker->randomElement(['Admin Provider', 'Admin Provider']),
            'Location' => $this->faker->address,
            'LOC_X' => $this->faker->latitude,
            'LOC_Y' => $this->faker->longitude,
            'name_company' => $this->faker->company,
            'stock' => $this->faker->randomFloat(2, 0, 1000), 
            'image' => $this->faker->randomElement([
                "https://t3.ftcdn.net/jpg/05/18/15/64/360_F_518156431_TdONavUmKrddaajQ4hLgc56xtDqkcciU.jpg",
                "https://www.google.com/imgres?q=logo%20dental%20&imgurl=https%3A%2F%2Fmarketplace.canva.com%2FEAFzZ7HIqYo%2F1%2F0%2F1600w%2Fcanva-blue-and-white-minimal-dental-care-logo-D-_h-rJgSAk.jpg&imgrefurl=https%3A%2F%2Fwww.canva.com%2Flogos%2Ftemplates%2Fdental%2F&docid=azIard0lL0eC_M&tbnid=Sfu6gy0Jc8WstM&vet=12ahUKEwjT3aetktKJAxWZU6QEHS6RMqMQM3oECGgQAA..i&w=1600&h=1600&hcb=2&ved=2ahUKEwjT3aetktKJAxWZU6QEHS6RMqMQM3oECGgQAA",
                "https://www.google.com/imgres?q=logo%20dental%20&imgurl=https%3A%2F%2Ft3.ftcdn.net%2Fjpg%2F05%2F18%2F15%2F64%2F360_F_518156431_TdONavUmKrddaajQ4hLgc56xtDqkcciU.jpg&imgrefurl=https%3A%2F%2Fstock.adobe.com%2Fsearch%3Fk%3D%2522dental%2Blogo%2522&docid=oXcnJB3Y5CF-qM&tbnid=jiMgFXXPrCx21M&vet=12ahUKEwjT3aetktKJAxWZU6QEHS6RMqMQM3oECBkQAA..i&w=630&h=360&hcb=2&ved=2ahUKEwjT3aetktKJAxWZU6QEHS6RMqMQM3oECBkQAA",
                "https://www.google.com/imgres?q=logo%20dental%20&imgurl=https%3A%2F%2Fwww.shutterstock.com%2Fimage-vector%2Fcombination-letter-s-tooth-symbol-600nw-1495549139.jpg&imgrefurl=https%3A%2F%2Fwww.shutterstock.com%2Fsearch%2Fdental-alphabet-logo&docid=mBKdlkvkVVoaOM&tbnid=2bZhZ30bIYXlTM&vet=12ahUKEwjT3aetktKJAxWZU6QEHS6RMqMQM3oECGMQAA..i&w=600&h=600&hcb=2&ved=2ahUKEwjT3aetktKJAxWZU6QEHS6RMqMQM3oECGMQAA",
                "https://marketplace.canva.com/EAFhS1Q0ABE/1/0/1600w/canva-red-mascot-free-dental-care-free-logo-Lci7vIcYbB4.jpg",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLRyfV_y2qEGmoX4Z__eLPvqOi5KZassx1hA&s",
                "https://d1csarkz8obe9u.cloudfront.net/posterpreviews/dental-logo-design-template-99823a0e7d826fa13480f95eac83f163_screen.jpg?ts=1624667153",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGuy4I_SkenbwNBFceRnrUcQXTNSsp4uvXjA&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-vfwjhUv6JQJ2b1ZXyIs6c7CBaARmWROQmA&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLnfah53krIIWk0eMWlwZuy7zQYnBfFehWdg&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ-b3p2mjE6gmC8rRyDruxk5pLAF49RKPl6ag&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ_Q8GRYQVynnqr1AdlWRusU4kPsJTMc7CJ1g&s",
                "https://cdn.vectorstock.com/i/1000v/99/02/creative-dental-clinic-logo-abstract-vector-44489902.jpg",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDBn_tmpTN-ZFZQmgie2bmSIqq2ON4pgx0NQ&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQ5FddFfaJ-bC-wmN8gpfbeaJ2QE55HMMLjQ&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQdOkJ5dIlgiJnVHftdVLRoZHFwt7w2uKVcpA&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRi9P0lpCsfWWKLKWoErSLDpZqn0oVftla2pw&s",
                "https://thumbs.dreamstime.com/b/dental-lab-logo-icon-template-dental-lab-logo-icon-template-symbol-301896255.jpg",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6Ab-1OYVdWpHoph7O2LCDcAEy6YTbjGA55A&s",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTr0B1GVAroL3qrwWY_Mv8XwhlAZw07gQELNA&s",
            ]), 
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
