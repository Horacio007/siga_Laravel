<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class estatus_aseguradoras extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estatusaseguradoras')->insert([
            'estatus' => 'Facturado'
        ]);

        DB::table('estatusaseguradoras')->insert([
            'estatus' => 'Pagado'
        ]);

        DB::table('estatusaseguradoras')->insert([
            'estatus' => 'Pendiente'
        ]);
    }
}
