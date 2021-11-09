<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /*Usuario Admin del Sitio*/
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password =  Hash::make('Admin123');
        $user->rol = 'Admin';
        $user->save();

    }
}
