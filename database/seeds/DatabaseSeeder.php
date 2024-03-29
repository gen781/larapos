<?php

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
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PelanggansTableSeeder::class);
        $this->call(SatuansTableSeeder::class);
        $this->call(ProduksTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
    }
}
