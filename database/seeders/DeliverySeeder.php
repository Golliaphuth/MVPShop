<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $delivery = Delivery::create([]);
        $delivery->translates()->create([
            'lang' => 'uk',
            'name' => 'Нова Пошта',
        ]);
        $delivery->translates()->create([
            'lang' => 'ru',
            'name' => 'Новая Почта',
        ]);
    }
}
