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

            'VER-ROLES',
            'CREAR-ROLES',
            'EDITAR-ROLES',
            'BORRAR-ROLES',

            'VER-USUARIOS',
            'CREAR-USUARIOS',
            'EDITAR-USUARIOS',
            'BORRAR-USUARIOS',

            'VER-REGISTROS',
            'CREAR-REGISTROS',
            'EDITAR-REGISTROS',
            'BORRAR-REGISTROS',
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
