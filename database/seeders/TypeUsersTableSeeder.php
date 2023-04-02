<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('typeUser')->insert([
            'nameType'=>'Desarrollador',  
            'descriptionType'=>'Rol creado para instalar',
            
          
      ]);
    }
}
