<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'last_name' => 'Чалый',
            'first_name' => 'Антон',
            'patronymic' => 'Анатольевич',
            'email' => 'golliaphuth@gmail.com',
            'phone' => '+380663617207',
            'location' => 'Харьков',
            'location_ref' => 'e71f8842-4b33-11e4-ab6d-005056801329',
            'password' => Hash::make('Anton-321'),
        ]);
    }
}
