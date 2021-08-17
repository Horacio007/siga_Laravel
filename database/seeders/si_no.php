<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class si_no extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('si_no')->insert([
            'nombre' => 'Si'
        ]);

        DB::table('users')->insert([
            'nombre' => 'No'
        ]);
    }
}
