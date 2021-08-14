<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   /*
        DB::table('users')->insert([
            'name' => 'ramon',
            'email' => 'ramon@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ernesto',
            'email' => 'ernesto@gmail.com',
            'password' => Hash::make('neto123'),
        ]);
        */
        DB::table('users')->insert([
            'name' => 'raul',
            'email' => 'raul@gmail.com',
            'password' => Hash::make('neto123'),
        ]);
    }
}
