<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SeederTablaRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'superadmin',
            'Tecnico Vacaciones',
            'Tecnico Descansos Medicos',
            'Tecnico Licencias',
<<<<<<< HEAD
            'Tecnico Aislamientos',
            'Tecnico Suspensiones'
=======
            'Tecnico Aislamientos'
>>>>>>> d6c1ee3e6a3f6cf1a49bf0727b926683bae3c42e
        ];
        foreach($roles as $r){
            DB::insert('insert into roles (name, guard_name) values (?,?)', [$r,'web']);
        }
    }
}
