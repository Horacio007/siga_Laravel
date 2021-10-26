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
            'name' => 'horacio',
            'email' => 'horacio@dtr-automotriz.com',
            'password' => Hash::make('admin123'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'ramon',
            'email' => 'ramon@dtr-automotriz.com',
            'password' => Hash::make('admin456'),
        ]);
        
        DB::table('users')->insert([
            'name' => 'alfredo',
            'email' => 'alfredo@dtr-automotriz.com',
            'password' => Hash::make('zamarripa123'),
        ]);

        DB::table('users')->insert([
            'name' => 'lucero',
            'email' => 'lucero@dtr-automotriz.com',
            'password' => Hash::make('lucero123'),
        ]);

        DB::table('users')->insert([
            'name' => 'alicia',
            'email' => 'alicia@dtr-automotriz.com',
            'password' => Hash::make('ortiz123'),
        ]);

        DB::table('users')->insert([
            'name' => 'janeth',
            'email' => 'janeth@dtr-automotriz.com',
            'password' => Hash::make('janeth123'),
        ]);


        DB::table('users')->insert([
            'name' => 'david',
            'email' => 'david@dtr-automotriz.com',
            'password' => Hash::make('alcorta123'),
        ]);

        DB::table('users')->insert([
            'name' => 'alejandra',
            'email' => 'alejandra@dtr-automotriz.com',
            'password' => Hash::make('rojas123'),
        ]);

        DB::table('users')->insert([
            'name' => 'antonio',
            'email' => 'antonio@dtr-automotriz.com',
            'password' => Hash::make('amaya123'),
        ]);

        DB::table('users')->insert([
            'name' => 'isela',
            'email' => 'isela@dtr-automotriz.com',
            'password' => Hash::make('delacruz123'),
        ]);
        
        // se agrrega el usuario de cielo
        DB::table('users')->insert([
            'name' => 'cielo',
            'email' => 'cielo@dtr-automotriz.com',
            'password' => Hash::make('beltran123'),
        ]);
        */
        //se agrega el usuario de perla cortez
        DB::table('users')->insert([
            'name' => 'perla',
            'email' => 'perla@dtr-automotriz.com',
            'password' => Hash::make('cortes123'),
        ]);
    }
}
