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

        $this->call(PropertyTypeSeeder::class);
        $this->call(ResidenceAreaSeeder::class);
        $this->call(SuburbsSeeder::class);
        $this->call(TaxTypeSeeder::class);
        $this->call(TaxSeeder::class);

        /*Usuario Admin del Sitio*/
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password =  Hash::make('Admin123');
        $user->rol = 'Admin';
        $user->save();

    }
}
