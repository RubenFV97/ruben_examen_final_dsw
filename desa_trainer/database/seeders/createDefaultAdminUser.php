<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class createDefaultAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear un usuario administrador por defecto
        $admin = new \App\Models\User();
        $admin->name = 'Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = \Hash::make('@Admin1234');
        $admin->role = 'admin';
        $admin->save();
    }
}
