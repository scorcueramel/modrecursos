<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Spatie -> seguridad
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [

            'ver-rols',
            'crear-rols',
            'editar-rols',
            'borrar-rols',

            'ver-registers',
            'crear-registers',
            'editar-registers',
            'borrar-registers',

            'ver-users',
            'crear-users',
            'editar-users',
            'borrar-users',
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
