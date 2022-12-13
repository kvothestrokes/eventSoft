<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        $user->name = "UsuarioA";
        $user->email = "usuario1@usuario1.com";
        $user->password = "12345678";
        $user->rol = "cliente";

        $user->save();

        $user2 = new User();

        $user2->name = "UsuarioB";
        $user2->email = "usuario2@usuario2.com";
        $user2->password = "12345678";
        $user2->rol = "vendedor";

        $user2->save();

        $user3 = new User();

        $user3->name = "UsuarioB";
        $user3->email = "usuario3@usuario3.com";
        $user3->password = "12345678";
        $user3->rol = "admin";

        $user3->save();
    }
}
