<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Lista de usuarios con sus roles
        $users = [
            [
                'name' => 'Miguel Angel Flores Valda',
                'email' => 'mflores@unifranz.edu.bo',
                'password' => 'admin',
                'role' => 'Administrador',
            ],
            [
                'name' => 'Jhasmany Torrico',
                'email' => 'jhasmany.torrico@unifranz.edu.bo',
                'password' => 'invitado',
                'role' => 'Colaborador',
            ],
            [
                'name' => 'Fabio Andres Ortega Cruz',
                'email' => 'scze.fabioandres.ortega.cr@unifranz.edu.bo',
                'password' => 'invitado',
                'role' => 'Becario',
            ],
            [
                'name' => 'Bianca Sthefania Aguilar Duran',
                'email' => 'scze.biancasthefania.aguilar.du@unifranz.edu.bo',
                'password' => 'invitado',
                'role' => 'Becario',
            ],
            [
                'name' => 'Guillermo Zegarra',
                'email' => 'scze.guillermoisrael.zegarra.go@unifranz.edu.bo',
                'password' => 'invitado',
                'role' => 'Becario',
            ],
        ];

        foreach ($users as $userData) {
            // Crear el rol si no existe
            $role = Role::firstOrCreate([
                'name' => $userData['role'],
                'guard_name' => 'web',
            ]);

            // Crear usuario o actualizar si ya existe
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => bcrypt($userData['password']), // Encripta la contraseña
                ]
            );

            // Asignar el rol si aún no lo tiene
            if (!$user->hasRole($userData['role'])) {
                $user->assignRole($role);
            }
        }
    }
}
