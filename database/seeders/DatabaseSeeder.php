<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    function truncate_tables()
    {
        User::truncate();
    }
    public function run()
    {
        // $this->truncate_tables();

        $this->call([
            AdminSeeder::class
        ]);
    }
}
