<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RoleSeeder::class);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@mail.fr',
            'password' => Hash::make('123456789'),
        ]);
        $admin->assignRole('admin');

        $charge_projet = User::factory()->create([
            'name' => 'charge_projet',
            'email' => 'charge_projet@mail.fr',
            'password' => Hash::make('123456789'),
        ]);
        $charge_projet->assignRole('charge_projet');

        $utilisateur = User::factory()->create([
            'name' => 'utilisateur',
            'email' => 'utilisateur@mail.fr',
            'password' => Hash::make('123456789'),
        ]);
        $utilisateur->assignRole('utilisateur');
    }
}
