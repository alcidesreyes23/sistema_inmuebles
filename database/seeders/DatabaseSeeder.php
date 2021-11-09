<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

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
    }
}
