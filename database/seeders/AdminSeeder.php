<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Mostafa Gamal" ,
            "phone" => "01121238817",
            "email" => "admin@email.com" ,
            "password" => "123456"
        ]);
    }
}
