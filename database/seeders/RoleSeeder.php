<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des roles
       $admin = Role::create(['name' => 'admin']);
       $charge_projet = Role::create(['name' => 'charge_projet']);
       $utilisateur = Role::create(['name' => 'utilisateur']);

        Permission::create(['name' => 'creation event']);
        Permission::create(['name' => 'validation event']);
        Permission::create(['name' => 'visualiser event']);

        $admin->givePermissionTo(['creation event','validation event','visualiser event']);
        $charge_projet->givePermissionTo(['creation event', 'visualiser event']);
        $utilisateur->givePermissionTo(['visualiser event']);
    }
}
