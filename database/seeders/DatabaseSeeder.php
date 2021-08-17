<?php

namespace Database\Seeders;

use App\Models\Estatusaseguradoras;
use App\Models\si_no;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(si_no::class);
        $this->call(Estatusaseguradoras::class);
    }
}
