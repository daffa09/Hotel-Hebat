<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipeKamar>
 */
class TipeKamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_kamar' => $this->faker->word(),
            'jumlah_kamar' => mt_rand(1, 100),
            'harga' => mt_rand(90000, 120000),
            'gambar' => "gambar.jpg",
        ];
    }
}
