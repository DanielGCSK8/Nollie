<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Administrador', 'Cliente'];
        foreach($roles as $rol)
        DB::table('roles')->insert([
            'role' => $rol
        ]);
    }
}
