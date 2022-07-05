<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = OrderStatus::create([
            'order' => 0
        ]);
        $status->translates()->create([
            'lang' => 'uk',
            'name' => 'Новий',
        ]);
        $status->translates()->create([
            'lang' => 'ru',
            'name' => 'Новый',
        ]);


        $status = OrderStatus::create([
            'order' => 1
        ]);
        $status->translates()->create([
            'lang' => 'uk',
            'name' => 'В обробці',
        ]);
        $status->translates()->create([
            'lang' => 'ru',
            'name' => 'В обработке',
        ]);


        $status = OrderStatus::create([
            'order' => 2
        ]);
        $status->translates()->create([
            'lang' => 'uk',
            'name' => 'Виконано',
        ]);
        $status->translates()->create([
            'lang' => 'ru',
            'name' => 'Выполнен',
        ]);


        $status = OrderStatus::create([
            'order' => 3
        ]);
        $status->translates()->create([
            'lang' => 'uk',
            'name' => 'Скасовано',
        ]);
        $status->translates()->create([
            'lang' => 'ru',
            'name' => 'Отменен',
        ]);
    }
}
